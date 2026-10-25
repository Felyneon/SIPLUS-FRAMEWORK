<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\PeminjamanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ruangan', [RuanganController::class, 'index']);

Route::get('/ruangan/tambah', [RuanganController::class, 'create']); 
Route::post('/ruangan', [RuanganController::class, 'store']);      




Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {

    return redirect()->route('login');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (Request $request) {

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:mahasiswa,pengelola',
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
Route::middleware(['auth'])->group(function () {
    Route::get('/peminjaman', [PeminjamanController::class, 'index']);
    Route::get('/peminjaman/tambah', [PeminjamanController::class, 'create']);
    Route::post('/peminjaman', [PeminjamanController::class, 'store']);
});

Route::middleware(['auth'])->group(function () {
    // Route Mahasiswa
    Route::get('/peminjaman', [PeminjamanController::class, 'index']);
    Route::get('/peminjaman/tambah', [PeminjamanController::class, 'create']);
    Route::post('/peminjaman', [PeminjamanController::class, 'store']);

    // Route Admin (Persetujuan Peminjaman)
    Route::get('/admin/peminjaman', [PeminjamanController::class, 'adminIndex']);
    Route::post('/admin/peminjaman/{id}/status', [PeminjamanController::class, 'updateStatus']);
});