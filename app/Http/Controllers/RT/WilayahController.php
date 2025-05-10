<?php
namespace App\Http\Controllers;

use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WilayahController extends Controller
{
    // Menampilkan halaman dengan data provinsi
    public function index()
    {
        // Mengambil semua data provinsi
        $provinsis = Provinsi::all(); // Pastikan menggunakan tabel yang benar
        return view('alamat.index', compact('provinsis'));
    }

    // Mengambil data kota berdasarkan provinsi
    public function getKotas($provinsiId)
    {
        $kotas = Kota::where('provinsi_id', $provinsiId)->get(); // Sesuaikan dengan relasi yang ada
        return response()->json($kotas);
    }

    // Mengambil data kecamatan berdasarkan kota
    public function getKecamatans($kotaId)
    {
        $kecamatans = Kecamatan::where('kota_id', $kotaId)->get(); // Sesuaikan dengan relasi yang ada
        return response()->json($kecamatans);
    }

    // Mengambil data kelurahan berdasarkan kecamatan
    public function getKelurahans($kecamatanId)
    {
        $kelurahans = Kelurahan::where('kecamatan_id', $kecamatanId)->get(); // Sesuaikan dengan relasi yang ada
        return response()->json($kelurahans);
    }

    public function getRT()
    {
        try {
            $rt = DB::table('bagian')->where('tipe_bagian', 'RT')->select('id', 'nama_bagian as nama')->get();
            if ($rt->isEmpty()) {
                Log::error('No RT data found in the bagian table.');
            }
            return response()->json($rt);
        } catch (\Exception $e) {
            Log::error('Error fetching RT data: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal memuat data RT: ' . $e->getMessage()], 500);
        }
    }

    public function getRW()
    {
        try {
            $rw = DB::table('bagian')->where('tipe_bagian', 'RW')->select('id', 'nama_bagian as nama')->get();
            if ($rw->isEmpty()) {
                Log::error('No RW data found in the bagian table.');
            }
            return response()->json($rw);
        } catch (\Exception $e) {
            Log::error('Error fetching RW data: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal memuat data RW: ' . $e->getMessage()], 500);
        }
    }
}