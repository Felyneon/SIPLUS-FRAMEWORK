<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

// --- Hanya untuk tamu (belum login) ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// --- Semua pengguna yang sudah login ---
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pengelola (1) dan mahasiswa (2)
    Route::middleware('role:1,2')->group(function () {
        Route::get('/ruangan', [RuanganController::class, 'index'])->name('ruangan.index');

        Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
        Route::get('/peminjaman/tambah', [PeminjamanController::class, 'create'])->name('peminjaman.create');
        Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
        Route::delete('/peminjaman/{peminjaman}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');
    });
});

// --- Khusus pengelola (role 1) ---
Route::middleware(['auth', 'isAdministrator'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Ruangan: operasi tulis
    Route::get('/ruangan/tambah', [RuanganController::class, 'create'])->name('ruangan.create');
// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/register', function () {
    return view('auth.register');
})->name('register');
});

Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:mahasiswa,pengelola',
        'nim' => 'nullable|required_if:role,mahasiswa|string',
        'nip' => 'nullable|required_if:role,pengelola|string',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'nim' => $request->role === 'mahasiswa' ? $request->nim : null,
        'nip' => $request->role === 'pengelola' ? $request->nip : null,
    ]);

    return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan masuk.');
});

// Protected Routes (Harus Login)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    // Ruangan (Dengan nama route lengkap agar tidak error)
    Route::get('/ruangan', [RuanganController::class, 'index'])->name('ruangan.index');
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