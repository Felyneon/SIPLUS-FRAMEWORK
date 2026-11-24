<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

// --- Hanya untuk tamu (belum login) ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:6,1');
});

// --- Semua pengguna yang sudah login ---
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profil pribadi untuk seluruh pengguna yang sudah login
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');


    // Pengelola (1) dan mahasiswa (2)
    Route::middleware('role:1,2')->group(function () {
        Route::get('/ruangan', [RuanganController::class, 'index'])->name('ruangan.index');

        // Status Peminjaman & Riwayat
        Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
        
        // Form Pengajuan Peminjaman Baru (Create)
        Route::get('/peminjaman/tambah', [PeminjamanController::class, 'create'])->name('peminjaman.create');
        Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
        
        // Halaman Detail / Penentuan Jam Pinjam (Full Frame)
        Route::get('/peminjaman/detail', function () {
            $user = auth()->user();
            $isPengelola = (int) session('user_role') === 1;
            return view('peminjaman.detail', compact('user', 'isPengelola'));
        })->name('peminjaman.detail');

        Route::delete('/peminjaman/{peminjaman}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');
    });

    // --- Khusus pengelola (role 1) ---
    Route::middleware('isAdministrator')->group(function () {
        // Alias /admin disediakan untuk pengujian hak akses sesuai Modul 10.
        Route::get('/admin', fn () => redirect()->route('admin.dashboard'))->name('admin.home');
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

        // Ruangan: operasi tulis
        Route::get('/ruangan/create', [RuanganController::class, 'create'])->name('ruangan.create');
        Route::post('/ruangan', [RuanganController::class, 'store'])->name('ruangan.store');
        Route::get('/ruangan/{ruangan}/edit', [RuanganController::class, 'edit'])->name('ruangan.edit');
        Route::put('/ruangan/{ruangan}', [RuanganController::class, 'update'])->name('ruangan.update');
        Route::delete('/ruangan/{ruangan}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');

        // Persetujuan peminjaman
        Route::get('/admin/peminjaman', [PeminjamanController::class, 'adminIndex'])->name('admin.peminjaman.index');
        Route::post('/admin/peminjaman/{peminjaman}/status', [PeminjamanController::class, 'updateStatus'])->name('admin.peminjaman.status');

        // Pengguna dan peran
        Route::get('/admin/pengguna', [UserController::class, 'index'])->name('admin.pengguna.index');
        Route::patch('/admin/pengguna/{user}/role', [UserController::class, 'updateRole'])->name('admin.pengguna.role');
    });
});