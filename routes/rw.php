<?php

use App\Http\Middleware\RT;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| RW Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function() {
    return redirect('/rw/dashboard');
});
Route::resource('dashboard', 'RW\DashboardController');
Route::resource('bagian', 'RW\BagianController');
Route::resource('inventaris', 'RW\InventarisController');
Route::resource('register', 'RW\RegisterController');
Route::resource('tamu-kunjungan', 'RW\TamuController');
Route::resource('pengumuman', 'RW\PengumumanController');
Route::resource('penduduk', 'RW\PendudukController');
Route::resource('pemilu', 'RW\PemiluController');
Route::resource('undangan-pemilu', 'RW\UndanganPemilu');
Route::resource('pengurus', 'RW\PengurusController');
Route::resource('rapat', 'RW\RapatController');
Route::resource('notulen', 'RW\NotulenController');
Route::resource('aspirasi', 'RW\AspirasiController');