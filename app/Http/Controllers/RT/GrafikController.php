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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GrafikController extends Controller
{
    public function index(Request $request)
    {
        // Ambil SEMUA data warga tanpa filter RT
        $query = Warga::query();
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $start = \Carbon\Carbon::parse($request->tanggal_mulai)->startOfDay();
            $end = \Carbon\Carbon::parse($request->tanggal_selesai)->endOfDay();
            $query->whereBetween('created_at', [$start, $end]);
        }
        $models = $query->get();

        // Menyusun data warga
        $warga = $models->map(function($val) {
            $status = "Tetap";
            $mutasi = \App\Models\MutasiWarga::where('id_warga', $val->id)->where('status', 'Pindah')->first();
            $sementara = \App\Models\PendudukSementara::where('id_warga', $val->id)->first();
            if ($mutasi) {
                $status = $mutasi->status;
            } elseif ($sementara) {
                $status = "Sementara";
            }
            return (object)[
                "nik" => $val->nik,
                "no_kk" => $val->no_kk,
                "id" => $val->id,
                "nama" => $val->nama,
                "jkel" => $val->jkel === "P" ? "Perempuan" : "Laki-laki",
                "alamat" => $val->alamat,
                "status" => $status,
            ];
        });

        // Hitung jumlah laki-laki dan perempuan dari semua data
        $jmlh_laki = Warga::where('jkel', 'L')->count();
        $jmlh_perempuan = Warga::where('jkel', 'P')->count();
        $pekerjaan = Warga::groupBy('pekerjaan')
            ->select('pekerjaan', DB::raw('count(*) as total'))
            ->get()
            ->toArray();
        $jmlh_kk = Warga::groupBy('no_kk')->count();
        $jmlh_penduduk = Warga::count();

        return view('pages.rt.grafik.index', [
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
            'no_rt' => 'required|exists:bagian,id',
            'no_rw' => 'required|exists:bagian,id',
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

        // Ambil user login
        $user = Auth::user();

        // Ambil nama bagian RT dan RW berdasarkan ID
        $rt = Bagian::find($user->id_bagian); // Gunakan id_bagian dari user login (RT)
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
            'id_bagian' => $user->id_bagian, // Pastikan id_bagian sesuai RT user login
            'nama' => $validatedData['nama'],
            'nik' => $validatedData['nik'],
            'no_kk' => $validatedData['no_kk'],
            'no_rt' => $rt ? $rt->nama_bagian : '',
            'no_rw' => $rw ? $rw->nama_bagian : '',
            'tgl_lahir' => $validatedData['tgl_lahir'],
            'jkel' => $validatedData['jkel'],
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
            'id_bagian' => $user->id_bagian,
            'tipe' => 'Warga',
            'username' => substr(strtolower($validatedData['nama']), 0, 2),
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
    $rts = \App\Models\Bagian::where('tipe_bagian', 'RT')->get();
    $rws = \App\Models\Bagian::where('tipe_bagian', 'RW')->get();

    $provinsi = Provinsi::all();
    $kota = Kota::all();
    $kecamatan = Kecamatan::all();
    $kelurahan = Kelurahan::all();
    $data = Warga::findOrFail($id);
    
    return view('pages.rt.penduduk.edit', compact('data','rts', 'rws', 'provinsi', 'kota', 'kecamatan', 'kelurahan'));
}

public function update(Request $request, $id)
{
    $penduduk = Warga::findOrFail($id);

    // Validasi input
    $validatedData = $request->validate([
        'nama' => 'required|string|max:255',
        'no_rt' => 'required|exists:bagian,id',
        'no_rw' => 'required|exists:bagian,id',
        'jkel' => 'required|in:P,L',
        'tgl_lahir' => 'required|date',
        'prov_ktp' => 'required|string',
        'kota_ktp' => 'required|string',
        'kec_ktp' => 'required|string',
        'kel_ktp' => 'required|string',
        'alamat_ktp' => 'required|string',
        'prov_tinggal' => 'nullable|string',
        'kota_tinggal' => 'nullable|string',
        'kec_tinggal' => 'nullable|string',
        'kel_tinggal' => 'nullable|string',
        'alamat_tinggal' => 'nullable|string',
    ]);

    // Cari RT dan RW berdasarkan ID
    $rt = Bagian::find($validatedData['no_rt']);
    $rw = Bagian::find($validatedData['no_rw']);

    // Ambil nama-nama wilayah dari id
    $prov_ktp_nama = $request->input('prov_ktp_nama') ?: optional(\App\Models\Provinsi::find($validatedData['prov_ktp']))->nama;
    $kota_ktp_nama = $request->input('kota_ktp_nama') ?: optional(\App\Models\Kota::find($validatedData['kota_ktp']))->nama;
    $kec_ktp_nama  = $request->input('kec_ktp_nama') ?: optional(\App\Models\Kecamatan::find($validatedData['kec_ktp']))->nama;
    $kel_ktp_nama  = $request->input('kel_ktp_nama') ?: optional(\App\Models\Kelurahan::find($validatedData['kel_ktp']))->nama;

    $prov_tinggal_nama = $request->input('prov_tinggal_nama') ?: optional(\App\Models\Provinsi::find($validatedData['prov_tinggal']))->nama;
    $kota_tinggal_nama = $request->input('kota_tinggal_nama') ?: optional(\App\Models\Kota::find($validatedData['kota_tinggal']))->nama;
    $kec_tinggal_nama  = $request->input('kec_tinggal_nama') ?: optional(\App\Models\Kecamatan::find($validatedData['kec_tinggal']))->nama;
    $kel_tinggal_nama  = $request->input('kel_tinggal_nama') ?: optional(\App\Models\Kelurahan::find($validatedData['kel_tinggal']))->nama;

    // Gabungkan alamat lengkap KTP (alamat jalan + kelurahan, kecamatan, kota, provinsi)
    $alamat_ktp = trim($validatedData['alamat_ktp']);
    $alamat_ktp_full = $alamat_ktp;
    if ($kel_ktp_nama) $alamat_ktp_full .= ', ' . $kel_ktp_nama;
    if ($kec_ktp_nama) $alamat_ktp_full .= ', ' . $kec_ktp_nama;
    if ($kota_ktp_nama) $alamat_ktp_full .= ', ' . $kota_ktp_nama;
    if ($prov_ktp_nama) $alamat_ktp_full .= ', ' . $prov_ktp_nama;

    // Gabungkan alamat lengkap tinggal (alamat jalan + kelurahan, kecamatan, kota, provinsi)
    $alamat_tinggal = trim($validatedData['alamat_tinggal'] ?? $alamat_ktp);
    $alamat_tinggal_full = $alamat_tinggal;
    if ($kel_tinggal_nama) $alamat_tinggal_full .= ', ' . $kel_tinggal_nama;
    if ($kec_tinggal_nama) $alamat_tinggal_full .= ', ' . $kec_tinggal_nama;
    if ($kota_tinggal_nama) $alamat_tinggal_full .= ', ' . $kota_tinggal_nama;
    if ($prov_tinggal_nama) $alamat_tinggal_full .= ', ' . $prov_tinggal_nama;

    // Update data warga (tidak membuat data baru)
    $penduduk->update([
        'id_bagian' => $rt->id,
        'nama' => $validatedData['nama'],
        'nik' => $request->input('nik', $penduduk->nik),
        'no_kk' => $request->input('no_kk', $penduduk->no_kk),
        'no_rt' => $rt->nama_bagian,
        'no_rw' => $rw->nama_bagian,
        'tgl_lahir' => $validatedData['tgl_lahir'],
        'jkel' => $validatedData['jkel'],
        'alamat' => $alamat_tinggal_full,
        'alamat_ktp' => $alamat_ktp_full,
        'prov_ktp' => $validatedData['prov_ktp'],
        'kota_ktp' => $validatedData['kota_ktp'],
        'kec_ktp' => $validatedData['kec_ktp'],
        'kel_ktp' => $validatedData['kel_ktp'],
        'prov_tinggal' => $validatedData['prov_tinggal'] ?? $request->input('prov_tinggal'),
        'kota_tinggal' => $validatedData['kota_tinggal'] ?? $request->input('kota_tinggal'),
        'kec_tinggal' => $validatedData['kec_tinggal'] ?? $request->input('kec_tinggal'),
        'kel_tinggal' => $validatedData['kel_tinggal'] ?? $request->input('kel_tinggal'),
        'alamat_tinggal' => $alamat_tinggal,
    ]);

    // Update data user terkait (jika ada user dengan id_warga = $penduduk->id)
    $user = User::where('id_warga', $penduduk->id)->first();
    if ($user) {
        $user->update([
            'id_bagian' => $rt->id,
            'username' => substr(strtolower($validatedData['nama']), 0, 2),
            'password' => bcrypt(substr(strtolower($validatedData['nama']), 0, 3) . date('Y', strtotime($validatedData['tgl_lahir']))),
        ]);
    }

    return redirect()->route('rt.penduduk.index')->with('success', 'Data penduduk berhasil diupdate');
}

    public function destroy($id)
    {
    $penduduk = Warga::findOrFail($id);
    $penduduk->delete();

    return redirect()->back()->with('success', 'Data penduduk berhasil dihapus.');
    }

    public function exportPdf(Request $request)
    {
        $rekap = \App\Models\Warga::select([
                'no_rw as rw',
                'no_rt as rt',
                DB::raw('DATE_FORMAT(created_at, "%M %Y") as bulan'),
                'no_kk',
                'nik',
                'nama',
                'jkel'
            ])
            ->get();

        return view('pages.rt.export.pdf', compact('rekap'));
    }
}
