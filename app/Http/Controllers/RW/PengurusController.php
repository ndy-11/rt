<?php

namespace App\Http\Controllers\RW;

use App\Http\Controllers\Controller;
use App\Models\Bagian;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Http\Request;

class PengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $bagian = Bagian::find($request->get('id_bagian'));

        if ($bagian->id == 1) {
            $user = User::where('id_bagian', '!=', $bagian->id)->where('tipe', "Warga")->get();
        } else {
            $user = User::where('id_bagian', $bagian->id)->where('tipe', "Warga")->get();
        }

        $data = [
            "bagian" => $bagian,
            "user" => $user,
        ];
        return view('pages.rw.bagian.create-pengurus', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_bagian = $request->get('id_bagian');

        if ($id_bagian == 1) {
            $id_user = $request->get('id_warga');
            foreach ($id_user as $val) {
                $user = User::find($val);
                $user->tipe = "RW";
                $user->id_bagian = 1;
                $user->save();
            }
        } else {
            $id_user = $request->get('id_warga');
            foreach ($id_user as $val) {
                $user = User::find($val);
                $user->tipe = "RT";
                $user->save();
            }
        }

        return redirect()->route('rw.bagian.show', $id_bagian);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bagian = Bagian::find($id);

        if ($bagian->id == 1) {
            // Tampilkan hanya user yang bertipe RW dan id_bagian = 1
            $pengurus = User::where('id_bagian', 1)
                ->where('tipe', 'RW')
                ->get();
        } else {
            // Tampilkan hanya user yang bertipe RT dan id_bagian = $bagian->id
            $pengurus = User::where('id_bagian', $bagian->id)
                ->where('tipe', 'RT')
                ->get();
        }

        return view('pages.rw.bagian.show', [
            'bagian' => $bagian,
            'pengurus' => $pengurus,
        ]);
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
        // Pastikan $id yang diterima adalah id user pengurus yang ingin dihapus
        $user = User::find($id);
        if ($user) {
            $user->tipe = "Warga";
            if ($user->warga && $user->warga->id_bagian) {
                $user->id_bagian = $user->warga->id_bagian;
            }
            $user->save();
        }
        return redirect()->back()->with('success', 'Pengurus berhasil dihapus.');
    }
}