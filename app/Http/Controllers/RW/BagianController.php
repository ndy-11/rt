<?php

namespace App\Http\Controllers\RW;

use App\Http\Controllers\Controller;
use App\Models\Bagian;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class BagianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $bagian = Bagian::all();
        return view('pages.rw.bagian.index', ['bagian' => $bagian]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // Ambil data provinsi, kota, kecamatan, kelurahan dari database
        $provinsi = \App\Models\Provinsi::all();
        $kota = \App\Models\Kota::all();
        $kecamatan = \App\Models\Kecamatan::all();
        $kelurahan = \App\Models\Kelurahan::all();

        return view('pages.rw.bagian.create', compact('provinsi', 'kota', 'kecamatan', 'kelurahan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input, samakan dengan PendudukController
        $validatedData = $request->validate([
            'nama_rt' => 'required|max:3|min:3',
            'nama' => 'required|string|max:255',
            'nik' => 'required|max:16|min:16',
            'no_kk' => 'required|max:16|min:16',
            'jkel' => 'required|in:P,L',
            'tgl_lahir' => 'required|date',
            'status_kawin' => 'required|in:Belum,Sudah',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'kewarganegaraan' => 'required|in:WNI,WNA',
            'kedudukan_keluarga' => 'required|in:Kepala,Anggota',
            'prov_ktp' => 'required|string',
            'kota_ktp' => 'required|string',
            'kec_ktp' => 'required|string',
            'kel_ktp' => 'required|string',
            'alamat_ktp' => 'required|string',
        ]);

        // Simpan Bagian (RT)
        $bagian = new Bagian;
        $bagian->nama_bagian = "RT " . $validatedData['nama_rt'];
        $bagian->tipe_bagian = "RT";
        $bagian->save();

        // Gabungkan alamat lengkap KTP (seperti di PendudukController)
        $provinsi = \App\Models\Provinsi::find($validatedData['prov_ktp']);
        $kota = \App\Models\Kota::find($validatedData['kota_ktp']);
        $kecamatan = \App\Models\Kecamatan::find($validatedData['kec_ktp']);
        $kelurahan = \App\Models\Kelurahan::find($validatedData['kel_ktp']);

        $alamat_ktp_full = trim($validatedData['alamat_ktp']);
        if ($kelurahan) $alamat_ktp_full .= ', ' . $kelurahan->nama;
        if ($kecamatan) $alamat_ktp_full .= ', ' . $kecamatan->nama;
        if ($kota) $alamat_ktp_full .= ', ' . $kota->nama;
        if ($provinsi) $alamat_ktp_full .= ', ' . $provinsi->nama;

        // Alamat tinggal, default sama dengan alamat KTP
        $alamat_tinggal_full = $alamat_ktp_full;

        // Simpan Warga
        $warga = Warga::create([
            'id_bagian' => $bagian->id,
            'nama' => $validatedData['nama'],
            'nik' => str_replace('-', '', $validatedData['nik']),
            'no_kk' => str_replace('-', '', $validatedData['no_kk']),
            'no_rt' => $bagian->nama_bagian,
            'no_rw' => '', // Jika ingin otomatis, tambahkan logic ambil RW terkait
            'tgl_lahir' => $validatedData['tgl_lahir'],
            'jkel' => $validatedData['jkel'],
            'status_kawin' => $validatedData['status_kawin'],
            'agama' => $validatedData['agama'],
            'pendidikan' => $validatedData['pendidikan'],
            'pekerjaan' => $validatedData['pekerjaan'],
            'kewarganegaraan' => $validatedData['kewarganegaraan'],
            'kedudukan_keluarga' => $validatedData['kedudukan_keluarga'],
            'alamat' => $alamat_tinggal_full,
            'alamat_ktp' => $alamat_ktp_full,
            'prov_ktp' => $validatedData['prov_ktp'],
            'kota_ktp' => $validatedData['kota_ktp'],
            'kec_ktp' => $validatedData['kec_ktp'],
            'kel_ktp' => $validatedData['kel_ktp'],
        ]);

        // Simpan User
        User::create([
            'id_warga' => $warga->id,
            'id_bagian' => $bagian->id,
            'tipe' => 'RT',
            'username' => substr(strtolower($warga->nama), 0, 2) . substr($warga->nik, 13, 3),
            'password' => bcrypt(substr(strtolower($warga->nama), 0, 3) . date('Y', strtotime($warga->tgl_lahir))),
        ]);

        return redirect()->route('rw.bagian.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $bagian = Bagian::find($id);
        $pengurus = User::where('id_bagian', $bagian->id)->get();

        $data = [
            "bagian" => $bagian,
            "pengurus" => $pengurus,
        ];

        return view('pages.rw.bagian.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
