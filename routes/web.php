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

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/ruangan', [RuanganController::class, 'index']);
    Route::get('/ruangan/tambah', [RuanganController::class, 'create']);
    Route::post('/ruangan', [RuanganController::class, 'store']);
    Route::get('/ruangan/{ruangan}/edit', [RuanganController::class, 'edit']);
    Route::put('/ruangan/{ruangan}', [RuanganController::class, 'update']);
    Route::delete('/ruangan/{ruangan}', [RuanganController::class, 'destroy']);
});