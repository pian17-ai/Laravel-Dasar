<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;

// Rute Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Rute yang dilindungi middleware
Route::middleware(['auth.custom'])->group(function () {
    // Halaman Utama
    Route::get('/', function () {
        return view('welcome');
    });
    // Rute untuk Buku (Resource)
    Route::resource('buku', BukuController::class); // Rute untuk Anggota (Resource)
    Route::resource('anggota', AnggotaController::class);
    // Rute untuk Peminjaman
    Route::resource('peminjaman', PeminjamanController::class);
    Route::get('peminjaman/{id}/kembali', [PeminjamanController::class, 'kembali'])->name('peminjaman.kembali');
    Route::get('laporan/peminjaman', [PeminjamanController::class, 'laporan'])->name('peminjaman.laporan');
});
