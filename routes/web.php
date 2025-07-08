<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportPendudukController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\WargaExport;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\RW\PendudukController as RWPendudukController;
use App\Http\Controllers\RT\PendudukController as RTPendudukController;
use App\http\Controller\RT\GrafikController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Auth::routes();

Route::get('/', function () {
    return redirect('/login');
});

Route::prefix('rw')->name('rw.')->middleware(['auth', 'rw', 'warga'])->group(function () {
    require 'rw.php';
});

Route::prefix('rt')->name('rt.')->middleware(['auth', 'rt', 'warga'])->group(function () {
    require 'rt.php';
});

Route::prefix('warga')->name('warga.')->middleware(['auth', 'warga'])->group(function () {
    require 'warga.php';
});

Route::get('/alamat', [WilayahController::class, 'index']);
Route::get('/get-provinsi', [WilayahController::class, 'getProvinsi']);
Route::get('/get-kota/{provinsiId}', [WilayahController::class, 'getKota']);
Route::get('/get-kecamatan/{kotaId}', [WilayahController::class, 'getKecamatan']);
Route::get('/get-kelurahan/{kecamatanId}', [WilayahController::class, 'getKelurahan']);
Route::get('/get-rt', [WilayahController::class, 'getRT']);
Route::get('/get-rw', [WilayahController::class, 'getRW']);

// Export routes for RW
Route::prefix('rw')->name('pages.rw.')->group(function () {
    Route::get('/export/excel', [ExportPendudukController::class, 'exportExcel'])->name('export.excel');
    Route::get('/export/pdf', [ExportPendudukController::class, 'exportPDF'])->name('export.pdf');
});

// Export routes for RT
Route::prefix('rt')->name('pages.rt.')->middleware(['auth', 'rt', 'warga'])->group(function () {
    Route::get('/export/excel', [ExportPendudukController::class, 'exportExcel'])->name('export.excel');
    Route::get('/export/pdf', [ExportPendudukController::class, 'exportPDF'])->name('export.pdf');
});

Route::delete('/rw/penduduk/{id}', [RWPendudukController::class, 'destroy'])->name('rw.penduduk.destroy');
Route::delete('/rt/penduduk/{id}', [RTPendudukController::class, 'destroy'])->name('rt.penduduk.destroy');
Route::get('/penduduk/{id}/edit', [RTPendudukController::class, 'edit'])->name('pages.rt.penduduk.edit');
Route::get('/penduduk/{id}/edit', [RWPendudukController::class, 'edit'])->name('pages.rw.penduduk.edit');
Route::put('/penduduk/{id}', [RWPendudukController::class, 'update'])->name('pages.rw.penduduk.update');
Route::put('/penduduk/{id}', [RTPendudukController::class, 'update'])->name('pages.rt.penduduk.update');