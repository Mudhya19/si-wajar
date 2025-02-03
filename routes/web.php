<?php

use App\Http\Controllers\backend\v1\MenuController;
use App\Http\Controllers\backend\v1\LaporanController;
use App\Http\Controllers\backend\v1\MasakanController;
use App\Http\Controllers\backend\v1\UserController;
use App\Http\Controllers\backend\v1\TransaksiController;
use App\Http\Controllers\backend\v1\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('backend.v1.templates.index');
});
Route::resource('menu', MenuController::class);
Route::resource('masakan', MasakanController::class);
Route::resource('user', UserController::class);
Route::resource('transaksi', TransaksiController::class);
Route::resource('laporan', LaporanController::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/', function () {return view('dashboard');})->name('dashboard');
    // Route::get('/', function () {
    //     return view('backend.v1.templates.index');
    // });
    // Route::resource('menu', MenuController::class);
    // Route::resource('masakan', MasakanController::class);
    // Route::resource('user', UserController::class);
    // Route::resource('transaksi', TransaksiController::class);
    // Route::resource('laporan', LaporanController::class);
});
