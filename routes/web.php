<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\AdminPeminjamanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PeminjamanController;

Route::get('/', function () {
    return view('welcome');
});

// Halaman & Proses Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Proses Logout
Route::post('/logout', [AuthController::class, 'logout']);

// Halaman Dashboard (Diproteksi middleware auth)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');


// Route peminjaman (sisi mahasiswa/user)
Route::middleware(['auth'])->group(function () {
    Route::get('/peminjaman', [PeminjamanController::class, 'index']);
    Route::get('/peminjaman/tambah', [PeminjamanController::class, 'create']);
    Route::post('/peminjaman', [PeminjamanController::class, 'store']);
});


// ===== ANGGOTA 3: Master Data Ruangan & Approval Admin =====
Route::middleware(['auth'])->group(function () {

    // CRUD Ruangan -> ruangan.index, create, store, edit, update, destroy
    // URL: /ruangan, /ruangan/create, /ruangan/{ruangan}/edit, dst.
    Route::resource('ruangan', RuanganController::class)->except(['show']);

    // Persetujuan peminjaman (Admin)
    Route::get('/admin/peminjaman', [AdminPeminjamanController::class, 'adminIndex'])
        ->name('admin.peminjaman.index');
    Route::patch('/admin/peminjaman/{peminjaman}/status', [AdminPeminjamanController::class, 'updateStatus'])
        ->name('admin.peminjaman.status');
});