<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Carbon\Carbon;

class WargaExport implements FromView
{
    protected $data;
    protected $view;

    // Ubah konstruktor agar menerima data dan nama view, bukan start/end
    public function __construct($data, $view)
    {
        $this->data = $data;
        $this->view = $view;
    }

    public function view(): View
    {
        // Kirim data langsung ke view
        return view($this->view, [
            'data' => $this->data
        ]);
    }
}