<?php
namespace App\Http\Controllers;

use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function index()
    {
        // Your existing index method code
    }

    // Mengambil data provinsi
    public function getProvinsi()
    {
        $provinsis = Provinsi::all();
        return response()->json($provinsis);
    }

    // Mengambil data kota berdasarkan provinsi
    public function getKota($provinsiId)
    {
        $kotas = Kota::where('provinsi_id', $provinsiId)->get();
        return response()->json($kotas);
    }

    // Mengambil data kecamatan berdasarkan kota
    public function getKecamatan($kotaId)
    {
        $kecamatans = Kecamatan::where('kota_id', $kotaId)->get();
        return response()->json($kecamatans);
    }

    // Mengambil data kelurahan berdasarkan kecamatan
    public function getKelurahan($kecamatanId)
    {
        $kelurahans = Kelurahan::where('kecamatan_id', $kecamatanId)->get();
        return response()->json($kelurahans);
    }
}