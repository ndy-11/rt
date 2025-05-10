<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Carbon\Carbon;

class WargaExport implements FromView
{
    protected $start;
    protected $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function view(): View
    {
        $query = DB::table('warga')
            ->select(
                'no_rw',
                'no_rt',
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw("SUM(CASE WHEN jkel = 'L' THEN 1 ELSE 0 END) as laki"),
                DB::raw("SUM(CASE WHEN jkel = 'P' THEN 1 ELSE 0 END) as perempuan")
            );

        if ($this->start && $this->end) {
            $query->whereBetween('created_at', [
                Carbon::parse($this->start)->startOfDay(),
                Carbon::parse($this->end)->endOfDay()
            ]);
        }

        $data = $query
            ->groupBy('no_rw', 'no_rt', DB::raw('MONTH(created_at)'))
            ->orderBy('no_rw', 'ASC')
            ->orderBy('no_rt', 'ASC')
            ->orderBy(DB::raw('MONTH(created_at)'), 'ASC')
            ->get();

        return view('pages.rw.export.excel', compact('data'));
    }
}
