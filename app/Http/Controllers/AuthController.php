<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   
    // Menampilkan form login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Memproses data yang diinput user saat login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek kecocokan data menggunakan Auth::attempt()
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Jika benar, arahkan ke halaman dashboard
            return redirect()->intended('/dashboard')
                             ->with('success', 'Berhasil login!');
        }

        // Jika salah, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang kamu masukkan salah.',
        ])->onlyInput('email');
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

