<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class WargaExport implements FromView
{
    protected $data;
    protected $view;

    public function __construct($data, $view)
    {
        // Pastikan data adalah koleksi numerik of object
        $this->data = collect($data)->map(function ($item) {
            return (object) $item;
        });
        $this->view = $view;
    }

    public function view(): View
    {
        return view($this->view, [
            'data' => $this->data
        ]);
    }
}