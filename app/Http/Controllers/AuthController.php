<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    // GET /login
    public function showLogin(): View
    {
        return view('halaman.login');
    }

    // POST /login
    public function login(LoginRequest $request): RedirectResponse
    {
        // Validasi sudah dijalankan oleh LoginRequest
        if (! Auth::attempt($request->validated(), $request->boolean('remember'))) {
            return back()
                ->withErrors(['email' => 'Email atau password yang kamu masukkan salah.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        // Role dibaca SETELAH login berhasil, lalu disimpan sekali di session
        session(['user_role' => Auth::user()->roleId()]);

        return redirect()->intended(route('dashboard'))
            ->with('success', 'Berhasil login!');
    }

    // GET /register
    public function showRegister(): View
    {
        return view('halaman.register');
    }

    // POST /register
    public function register(RegisterRequest $request): RedirectResponse
    {
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
            'nim'      => $request->role === 'mahasiswa' ? $request->nim : null,
            'nip'      => $request->role === 'pengelola' ? $request->nip : null,
        ]);

        UserRole::create([
            'user_id' => $user->id,
            'role_id' => $request->role === 'pengelola' ? Role::PENGELOLA : Role::MAHASISWA,
        ]);

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil! Silakan masuk.');
    }

    // POST /logout
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Anda telah keluar.');
    }
}