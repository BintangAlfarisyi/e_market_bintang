<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;

// Route::get('/', [HomeController::class, 'index']);
Route::get('/', [HomeController::class, 'index']);
Route::get('/profile', [HomeController::class, 'profile']);
Route::get('/contact', [HomeController::class, 'contact']);
// Route::get('/produk', [ProdukController::class, 'index']);
// Route::post('/produk', [ProdukController::class, 'store']);
Route::resource('/produk', ProdukController::class);

// Route::get('/barang', [BarangController::class, 'index']);
// Route::post('/barang', [BarangController::class, 'store']);
Route::resource('/barang', BarangController::class);

Route::resource('/pemasok', PemasokController::class);

Route::resource('/pelanggan', PelangganController::class);

Route::resource('/user', UserController::class);

Route::resource('/pembelian', PembelianController::class);

Route::get('/download', [ProdukController::class, 'download']);

Route::get('/dashboard', [DashboardController::class, 'dashboard']);
Route::get('/blog', [DashboardController::class, 'blog']);

Route::get('generatepdf', [ProdukController::class, 'generatepdf'])->name('dpdf');
Route::get('generateexcel', [ProdukController::class, 'generateexcel'])->name('dexcel');