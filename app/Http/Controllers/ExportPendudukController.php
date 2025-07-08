<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\WargaExport;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;

class ExportPendudukController extends Controller
{
    // Export ke Excel
      public function exportExcel(Request $request)
    {
        $query = Warga::query();

        // Filter berdasarkan parameter
        if ($request->filled('rt')) {
            $query->where('no_rt', 'like', '%' . $request->rt . '%');
        }

        if ($request->filled('rw')) {
            $query->where('no_rw', 'like', '%' . $request->rw . '%');
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $start = Carbon::parse($request->start_date)->startOfDay();
            $end = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$start, $end]);
        }

        // Ambil data lengkap
        $data = $query->select(
            'no_rw',
            'no_rt',
            DB::raw('MONTH(created_at) as bulan'),
            'no_kk',
            'nik',
            'nama',
            'jkel',
            'alamat'
        )
        ->orderBy('no_rw', 'ASC')
        ->orderBy('no_rt', 'ASC')
        ->orderBy(DB::raw('MONTH(created_at)'), 'ASC')
        ->get();

        // Pilih view sesuai kebutuhan
        if ($request->filled('rw')) {
            $view = 'pages.rw.export.excel';
        } elseif ($request->filled('rt')) {
            $view = 'pages.rt.export.excel';
        } else {
            $view = 'exports.warga';
        }

        // Kirim data ke export, bukan request array
        return Excel::download(new \App\Exports\WargaExport($data, $view), 'data_warga.xlsx');
    }


    // Export ke PDF dan langsung unduh
    public function exportPDF(Request $request)
    {
        $query = Warga::query();
    
        // Filter berdasarkan RT (untuk RT hanya filter tanggal)
        if ($request->filled('rt')) {
            $rt = 'RT ' . str_pad($request->rt, 3, '0', STR_PAD_LEFT);
            $query->where('no_rt', '=', $rt);
        }
    
        // Filter berdasarkan RW (untuk RW hanya filter RT dan RW)
        if ($request->filled('rw')) {
            $rw = 'RW ' . str_pad($request->rw, 3, '0', STR_PAD_LEFT);
            $query->where('no_rw', '=', $rw);
        }
    
        // Filter berdasarkan tanggal (untuk RT dan RW sama-sama)
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $start = Carbon::parse($request->start_date)->startOfDay();
            $end = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$start, $end]);
        }
    
        // Ambil data setelah filter diterapkan
        $rawData = $query->get();
    
        if ($rawData->isEmpty()) {
            return back()->with('error', 'Data tidak ditemukan sesuai filter.');
        }
    
        // Proses data (kelompokkan dan hitung)
        $groupedData = $rawData->groupBy(function ($item) {
            return $item->no_rw . '|' . $item->no_rt . '|' . $item->created_at->format('Y-m');
        })->map(function ($group) {
            $first = $group->first();
            // Ambil dari field jkel jika ada, jika tidak dari jenis_kelamin, lalu normalisasi
            $jkel = $first->jkel ?? $first->jenis_kelamin ?? '';
            if ($jkel === 'L' || strtolower($jkel) === 'laki-laki') {
                $jkel = 'Laki-laki';
            } elseif ($jkel === 'P' || strtolower($jkel) === 'perempuan') {
                $jkel = 'Perempuan';
            }
            return (object)[
                'rw'        => $first->no_rw,
                'rt'        => $first->no_rt,
                'bulan'     => $first->created_at->translatedFormat('F'),
                'bulan_num' => $first->created_at->format('m'),
                'no_kk'     => $first->no_kk,
                'nik'       => $first->nik,
                'nama'      => $first->nama,
                'jkel'      => $jkel,
                'alamat'    => $first->alamat,
            ];
        })->sortBy(function ($item) {
            return $item->rw . '-' . $item->rt . '-' . $item->bulan_num;
        })->values();
    
        // Tentukan view berdasarkan apakah filter RW atau RT ada
        if ($request->filled('rw')) {
            // Jika filter RW ada, gunakan view untuk RW
            $view = 'pages.rw.export.pdf';
        } else {
            // Jika hanya filter RT yang ada, gunakan view untuk RT
            $view = 'pages.rt.export.pdf';
        }
    
        // Kirim data siap ke view
        $pdf = PDF::loadView($view, ['rekap' => $groupedData]);
        return $pdf->download('data_warga.pdf');
    }
        
}
