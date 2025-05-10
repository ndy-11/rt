<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RT\WilayahController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// routes/api.php

Route::get('provinsi', [WilayahController::class, 'provinsi']);
Route::get('kota', [WilayahController::class, 'kota']);
Route::get('kecamatan', [WilayahController::class, 'kecamatan']);
Route::get('kelurahan', [WilayahController::class, 'kelurahan']);


