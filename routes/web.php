<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BagianController;
use App\Http\Controllers\StatusBarangController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\TipeBarangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Barang Routes
Route::resource('barang', BarangController::class);
Route::get('barang/tipe/{idJenis}', [BarangController::class, 'getTipeByJenis'])->name('barang.tipe');

// Master Data Routes
Route::resource('bagian', BagianController::class);
Route::resource('status-barang', StatusBarangController::class);
Route::resource('jenis-barang', JenisBarangController::class);
Route::resource('tipe-barang', TipeBarangController::class);
