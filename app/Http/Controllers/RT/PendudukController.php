<?php

namespace App\Http\Controllers\RT;

use App\Http\Controllers\Controller;
use App\Models\MutasiWarga;
use App\Models\PendudukSementara;
use App\Models\User;
use App\Models\Warga;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Bagian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PendudukController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil data warga berdasarkan bagian (RT/RW) yang sedang login
        $query = Warga::where('id_bagian', Auth::user()->id_bagian);
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('created_at', [$request->tanggal_mulai, $request->tanggal_selesai]);
        }
        $models = $query->get();

        // Menyusun data warga
        $warga = $models->map(function($val) {
            $status = "Tetap";
            
            // Memeriksa apakah warga sudah pindah atau sementara
            $mutasi = MutasiWarga::where('id_warga', $val->id)->where('status', 'Pindah')->first();
            $sementara = PendudukSementara::where('id_warga', $val->id)->first();

            // Menentukan status berdasarkan kondisi
            if ($mutasi) {
                $status = $mutasi->status;
            } elseif ($sementara) {
                $status = "Sementara";
            }

            // Mengembalikan data dalam format objek untuk tabel
            return (object)[
                "id" => $val->id,
                "nama" => $val->nama,
                "jkel" => $val->jkel === "P" ? "Perempuan" : "Laki-laki",
                "alamat" => $val->alamat,
                "status" => $status,
            ];
        });

        // Menghitung jumlah data berdasarkan kategori
        $jmlh_laki = Warga::where('id_bagian', Auth::user()->id_bagian)->where('jkel', 'L')->count();
        $jmlh_perempuan = Warga::where('id_bagian', Auth::user()->id_bagian)->where('jkel', 'P')->count();
        $pekerjaan = Warga::where('id_bagian', Auth::user()->id_bagian)
            ->groupBy('pekerjaan')
            ->select('pekerjaan', DB::raw('count(*) as total'))
            ->get()
            ->toArray();
        $jmlh_kk = Warga::where('id_bagian', Auth::user()->id_bagian)->groupBy('no_kk')->count();
        $jmlh_penduduk = Warga::where('id_bagian', Auth::user()->id_bagian)->count();

        // Mengirim data ke view
        return view('pages.rt.penduduk.index', [
            "warga" => $warga,
            "jkel" => [$jmlh_laki, $jmlh_perempuan],
            "pekerjaan" => $pekerjaan,
            "jmlh_kk" => $jmlh_kk,
            "jmlh_penduduk" => $jmlh_penduduk,
        ]);
    }

    public function create()
    {
        // Ambil data RT dan RW dari tabel bagian
        $rts = \App\Models\Bagian::where('tipe_bagian', 'RT')->get();
        $rws = \App\Models\Bagian::where('tipe_bagian', 'RW')->get();
    
        // Ambil data provinsi, kota, kecamatan, dan kelurahan dari database lokal
        $provinsi = Provinsi::all();
        $kota = Kota::all();
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();
    
        // Kirim data RT dan RW ke view
        return view('pages.rt.penduduk.create', compact('rts', 'rws', 'provinsi', 'kota', 'kecamatan', 'kelurahan'));
    }
    
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:warga,nik',
            'no_kk' => 'required|string|max:16',
            'no_rt' => 'required|exists:bagian,id', // menggunakan ID RT
            'no_rw' => 'required|exists:bagian,id', // menggunakan ID RW
            'jkel' => 'required|in:P,L',
            'tgl_lahir' => 'required|date',
            'status_kawin' => 'required|in:Belum,Sudah',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha',
            'pendidikan' => 'required|string',
            'pekerjaan' => 'required|string',
            'kewarganegaraan' => 'required|in:WNI,WNA',
            'kedudukan_keluarga' => 'required|in:Kepala,Anggota',
            'prov_ktp' => 'required|string',
            'kota_ktp' => 'required|string',
            'kec_ktp' => 'required|string',
            'kel_ktp' => 'required|string',
            'alamat_ktp' => 'required|string',
        ]);
    
        // Ambil nama bagian RT dan RW berdasarkan ID
        $rt = Bagian::find($request->no_rt);
        $rw = Bagian::find($request->no_rw);
    
        // Gabungkan alamat lengkap KTP
        $alamat_ktp = $validatedData['alamat_ktp'] . ', '
            . $validatedData['kel_ktp'] . ', '
            . $validatedData['kec_ktp'] . ', '
            . $validatedData['kota_ktp'] . ', '
            . $validatedData['prov_ktp'];
    
        // Alamat tempat tinggal, sementara sama dengan alamat KTP
        $alamat_tinggal = $alamat_ktp;
    
        // Simpan data ke tabel warga menggunakan Eloquent
        $warga = Warga::create([
            'id_bagian' => $rt->id, // otomatis ambil dari RT
            'nama' => $validatedData['nama'],
            'nik' => $validatedData['nik'],
            'no_kk' => $validatedData['no_kk'],
            'no_rt' => $rt->nama_bagian,
            'no_rw' => $rw->nama_bagian,
            'agama' => $validatedData['agama'],
            'tgl_lahir' => $validatedData['tgl_lahir'],
            'jkel' => $validatedData['jkel'],
            'status_kawin' => $validatedData['status_kawin'],
            'pendidikan' => $validatedData['pendidikan'],
            'pekerjaan' => $validatedData['pekerjaan'],
            'kewarganegaraan' => $validatedData['kewarganegaraan'],
            'kedudukan_keluarga' => $validatedData['kedudukan_keluarga'],
            'alamat' => $alamat_tinggal,
            'alamat_ktp' => $alamat_ktp,
            'prov_ktp' => $validatedData['prov_ktp'],
            'kota_ktp' => $validatedData['kota_ktp'],
            'kec_ktp' => $validatedData['kec_ktp'],
            'kel_ktp' => $validatedData['kel_ktp'],
        ]);
    
        // Ambil ID warga yang baru disimpan
        $wargaBaru = Warga::find($warga->id);
    
        // Simpan juga ke tabel users menggunakan Eloquent
        User::create([
            'id_warga' => $wargaBaru->id,
            'id_bagian' => $rt->id,
            'tipe' => 'Warga',
            'username' => substr(strtolower($validatedData['nama']), 0, 2) . substr($validatedData['nik'], 13, 3),
            'password' => bcrypt(substr(strtolower($validatedData['nama']), 0, 3) . date('Y', strtotime($validatedData['tgl_lahir']))),
        ]);
    
        return redirect()->route('rt.penduduk.index')->with('success', 'Data penduduk berhasil ditambahkan.');
    }

    public function show($id)
    {
        $warga = Warga::findOrFail($id);
        return view('pages.rt.penduduk.detail', ['warga' => $warga]);
    }

    public function edit($id)
    {
        // Future editing logic here
    }

    public function update(Request $request, $id)
    {
        // Future update logic here
    }

    public function destroy($id)
    {
        // Future delete logic here
    }
}
