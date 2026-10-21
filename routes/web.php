<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PeminjamanController;

Route::get('/', function () {
    return view('welcome');
});

// Menghubungkan URL /ruangan ke RuanganController
Route::get('/ruangan', [RuanganController::class, 'index']);

// form tambah ruangan untuk admin
Route::get('/ruangan/tambah', [RuanganController::class, 'create']); // Menampilkan form
Route::post('/ruangan', [RuanganController::class, 'store']);       // Memproses form



// Halaman & Proses Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Proses Logout
Route::post('/logout', [AuthController::class, 'logout']);

// Halaman Dashboard (Diproteksi middleware auth)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');


// route peminjaman
Route::middleware(['auth'])->group(function () {
    Route::get('/peminjaman', [PeminjamanController::class, 'index']);
    Route::get('/peminjaman/tambah', [PeminjamanController::class, 'create']);
    Route::post('/peminjaman', [PeminjamanController::class, 'store']);
});


// route admin peminjaman setuju,tolak,pending
Route::middleware(['auth'])->group(function () {
    // Route Mahasiswa
    Route::get('/peminjaman', [PeminjamanController::class, 'index']);
    Route::get('/peminjaman/tambah', [PeminjamanController::class, 'create']);
    Route::post('/peminjaman', [PeminjamanController::class, 'store']);

    // Route Admin (Persetujuan Peminjaman)
    Route::get('/admin/peminjaman', [PeminjamanController::class, 'adminIndex']);
    Route::post('/admin/peminjaman/{id}/status', [PeminjamanController::class, 'updateStatus']);
});