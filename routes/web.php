<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\AuthController;

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