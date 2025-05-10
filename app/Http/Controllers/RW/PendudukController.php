<?php

namespace App\Http\Controllers\RW;

use App\Http\Controllers\Controller;
use App\Models\Bagian;
use App\Models\MutasiWarga;
use App\Models\PendudukSementara;
use App\Models\Warga;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Ambil data bagian untuk filter RT
        $bagian = Bagian::where('tipe_bagian', 'RT')->get();

        // Ambil data RW dari table Warga (distinct)
        $rwOptions = Warga::select('no_rw')->distinct()->get()->pluck('no_rw');

        // Ambil data RT dari table Warga (distinct)
        $rtOptions = Warga::select('no_rt')->distinct()->get()->pluck('no_rt');

        // Ambil nilai filter yang dikirimkan
        $rts = $request->get('rts'); // 'rts' is the RT filter
        $rw = $request->get('rw');
        $tanggal_mulai = $request->get('tanggal_mulai');
        $tanggal_selesai = $request->get('tanggal_selesai');

        // Query dasar warga
        $query = Warga::query();

        // Terapkan filter RT jika ada
        if ($rts) {
            $query->where('no_rt', $rts);
        }

        // Terapkan filter RW jika ada
        if ($rw) {
            $query->where('no_rw', $rw);
        }

        // Terapkan filter tanggal jika ada
        if ($tanggal_mulai) {
            $query->whereDate('created_at', '>=', $tanggal_mulai);
        }

        if ($tanggal_selesai) {
            $query->whereDate('created_at', '<=', $tanggal_selesai);
        }

        // Ambil data warga hasil filter
        $warga = $query->orderBy('created_at', 'DESC')->get();

        // Hitung jumlah KK unik
        $jmlh_kk = $warga->unique('no_kk')->count();
        $jmlh_warga = 0;
        $jmlh_sementara = 0;
        $list_warga = [];

        foreach ($warga as $val) {
            $status = "Tetap";

            $mutasi = MutasiWarga::where('id_warga', $val->id)->where('status', ['Pindah'])->first();
            $sementara = PendudukSementara::where('id_warga', $val->id)->first();

            if ($mutasi) {
                $status = $mutasi->status;
            } else if ($sementara) {
                $status = "Sementara";
            }

            if ($status == "Sementara" || $status == "Tetap") {
                $jmlh_warga++;
            }

            if ($status == "Sementara") {
                $jmlh_sementara++;
            }

            $list_warga[] = [
                "nik" => $val->nik,
                "nama" => $val->nama,
                "jkel" => $val->jkel === "P" ? "Perempuan" : "Laki-laki",
                "alamat" => $val->alamat,
                "status" => $status,
                "wilayah" => $val->bagian ? $val->bagian->nama_bagian : 'Tidak Diketahui',
                "id" => $val->id
            ];
        }

        // Grafik Jenis Kelamin (grouping)
        $jkel = $query->select('jkel', DB::raw('count(*) as total'))
            ->groupBy('jkel')
            ->get();

        $persebaran = [];
        $bagianList = Bagian::where('tipe_bagian', 'RT')->get();

        foreach ($bagianList as $bag) {
            $countQuery = Warga::where('no_rt', $bag->nama_bagian)
                ->whereDoesntHave('mutasi', function (Builder $query) {
                    $query->where('mutasi_warga.status', '=', 'Meninggal');
                });

            // Apply filters to the count query
            if ($rts) {
                $countQuery->where('no_rt', $rts);
            }
            if ($rw) {
                $countQuery->where('no_rw', $rw);
            }
            if ($tanggal_mulai) {
                $countQuery->whereDate('created_at', '>=', $tanggal_mulai);
            }
            if ($tanggal_selesai) {
                $countQuery->whereDate('created_at', '<=', $tanggal_selesai);
            }

            $count = $countQuery->count();

            $persebaran[] = [
                "nama_bagian" => $bag->nama_bagian,
                "jmlh_warga" => $count
            ];
        }

        // Kirim ke view
        $data = [
            'bagian' => $bagian,
            'rwOptions' => $rwOptions,
            'rtOptions' => $rtOptions, // Pass RT options to the view
            'jmlh_warga' => $jmlh_warga,
            'jmlh_kk' => $jmlh_kk,
            'jmlh_sementara' => $jmlh_sementara,
            'list_warga' => $list_warga,
            'persebaran' => $persebaran,
            'jkel' => $jkel,
            'id_bagian' => $rts, // Pass the selected RT to the view
        ];

        return view('pages.rw.penduduk.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $warga = Warga::where('id', $id)->first();
        $data = [
            'warga' => $warga,
        ];
        return view('pages.rw.penduduk.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}