<?php

namespace App\Http\Controllers\RW;

use App\Http\Controllers\Controller;
use App\Models\Bagian;
use App\Models\MutasiWarga;
use App\Models\PendudukSementara;
use App\Models\Warga;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


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
                "no_kk" => $val->no_kk,
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

        $pekerjaan = $query->select('pekerjaan', DB::raw('count(*) as total'))
            ->groupBy('pekerjaan')
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
            'pekerjaan' => $pekerjaan,
            'id_bagian' => $rts,
        ];
        $warga = Warga::all();
        return view('pages.rw.penduduk.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        return view('pages.rw.penduduk.create', compact('rts', 'rws', 'provinsi', 'kota', 'kecamatan', 'kelurahan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'no_rt' => 'required|exists:bagian,id', // menggunakan ID RT
            'no_rw' => 'required|exists:bagian,id', // menggunakan ID RW
            'jkel' => 'required|in:P,L',
            'status_kawin' => 'required|in:Belum,Sudah',
            'pekerjaan' => 'nullable|string|max:255',
            'nik' => 'nullable|string|max:16|unique:warga,nik',
            'no_kk' => 'nullable|string|max:16|unique:warga,no_kk',
            'agama' => 'required|string|max:50',
            'pendidikan' => 'required|string|max:50',
            'kewarganegaraan' => 'required|string|max:50',
            'kedudukan_keluarga' => 'required|string|max:50',
            'alamat' => 'required|string|max:255',
            'alamat_ktp' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
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
        $alamat_ktp = $validatedData['alamat_ktp'];

        // Alamat tempat tinggal, sementara sama dengan alamat KTP
        $alamat_tinggal = $alamat_ktp;

        // Simpan data ke tabel warga menggunakan Eloquent
        $warga = Warga::create([
            'id_bagian' => $rt->id, // otomatis ambil dari RT
            'nama' => $validatedData['nama'],
            'no_rt' => $rt->nama_bagian,
            'no_rw' => $rw->nama_bagian,
            'tgl_lahir' => $validatedData['tgl_lahir'],
            'jkel' => $validatedData['jkel'],
            'status_kawin' => $validatedData['status_kawin'],
            'nik' => $validatedData['nik'],
            'no_kk' => $validatedData['no_kk'],
            'agama' => $validatedData['agama'],
            'pendidikan' => $validatedData['pendidikan'],
            'pekerjaan' => $validatedData['pekerjaan'],
            'kewarganegaraan' => $validatedData['kewarganegaraan'],
            'kedudukan_keluarga' => $validatedData['kedudukan_keluarga'],
            'alamat' => $alamat_tinggal,
            'alamat_ktp' => $alamat_ktp,
            'prov_ktp' => $validatedData['prov_ktp'] ?? $request->input('prov_ktp'),
            'kota_ktp' => $validatedData['kota_ktp'] ?? $request->input('kota_ktp'),
            'kec_ktp' => $validatedData['kec_ktp'] ?? $request->input('kec_ktp'),
            'kel_ktp' => $validatedData['kel_ktp'] ?? $request->input('kel_ktp'),
        ]);

        // Ambil ID warga yang baru disimpan
        $wargaBaru = Warga::find($warga->id);

        // Simpan juga ke tabel users menggunakan Eloquent
        User::create([
            'id_warga' => $wargaBaru->id,
            'id_bagian' => $rt->id,
            'tipe' => 'Warga',
            'username' => substr(strtolower($validatedData['nama']), 0, 2),
            'password' => bcrypt(substr(strtolower($validatedData['nama']), 0, 3) . date('Y', strtotime($validatedData['tgl_lahir']))),
        ]);

        return redirect()->route('rw.penduduk.index')->with('success', 'Data penduduk berhasil ditambahkan.');
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
        $rts = \App\Models\Bagian::where('tipe_bagian', 'RT')->get();
        $rws = \App\Models\Bagian::where('tipe_bagian', 'RW')->get();

        $provinsi = Provinsi::all();
        $kota = Kota::all();
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();
        $data = Warga::findOrFail($id);

        return view('pages.rw.penduduk.edit', compact('data', 'rts', 'rws', 'provinsi', 'kota', 'kecamatan', 'kelurahan'));
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

        $penduduk->update([
            'id_bagian' => $rt->id,
            'nama' => $validatedData['nama'],
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

        return redirect()->route('rw.penduduk.index')->with('success', 'Data penduduk berhasil diupdate');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penduduk = Warga::findOrFail($id);
        $penduduk->delete();

        return redirect()->back()->with('success', 'Data penduduk berhasil dihapus.');
    }
}
