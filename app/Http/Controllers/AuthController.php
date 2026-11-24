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
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function showLogin(): View
    {
        return view('halaman.login');
    }

    /**
     * Proses login menggunakan email dan password.
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        // Mengambil email dan password yang sudah divalidasi.
        $credentials = $request->safe()->only([
            'email',
            'password',
        ]);

        // Memeriksa email dan password.
        if (!Auth::attempt(
            $credentials,
            $request->boolean('remember')
        )) {
            return back()
                ->withErrors([
                    'email' => 'Email atau password yang kamu masukkan salah.',
                ])
                ->onlyInput('email');
        }

        // Memperbarui session setelah login berhasil.
        $request->session()->regenerate();

        // Mengambil pengguna yang berhasil login.
        $user = Auth::user();

        // Mengambil role pengguna dari relasi user_roles.
        $roleId = $user->roleId();

        // Memastikan pengguna mempunyai role yang valid.
        if (!in_array(
            $roleId,
            [Role::PENGELOLA, Role::MAHASISWA],
            true
        )) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->withErrors([
                    'email' => 'Akun tidak memiliki hak akses yang valid.',
                ]);
        }

        // Menyimpan role pengguna ke dalam session.
        session([
            'user_role' => $roleId,
        ]);

        return redirect()
            ->intended(route('dashboard'))
            ->with('success', 'Berhasil login!');
    }

    /**
     * Menampilkan halaman registrasi.
     */
    public function showRegister(): View
    {
        return view('halaman.register');
    }

    /**
     * Proses registrasi pengguna.
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        // Mengambil data yang sudah lolos validasi.
        $data = $request->safe()->only([
            'name',
            'email',
            'password',
            'role',
            'jenis_identitas',
            'nomor_identitas',
        ]);

        // Menentukan ID role berdasarkan jenis akun.
        $roleId = $data['role'] === 'pengelola'
            ? Role::PENGELOLA
            : Role::MAHASISWA;

        // Menyesuaikan identitas dengan kolom lama.
        $nim = $data['jenis_identitas'] === 'nim'
            ? $data['nomor_identitas']
            : null;

        $nip = $data['jenis_identitas'] === 'nip'
            ? $data['nomor_identitas']
            : null;

        // Membuat pengguna dan relasi role dalam satu transaksi.
        DB::transaction(function () use (
            $data,
            $roleId,
            $nim,
            $nip
        ) {
            $user = User::create([
                'name'            => $data['name'],
                'email'           => $data['email'],
                'password'        => $data['password'],
                'role'            => $data['role'],

                // Menyimpan identitas utama.
                'jenis_identitas' => $data['jenis_identitas'],
                'nomor_identitas' => $data['nomor_identitas'],

                // Menjaga kompatibilitas dengan kolom lama.
                'nim'             => $nim,
                'nip'             => $nip,
            ]);

            // Menyimpan relasi pengguna dengan role.
            UserRole::create([
                'user_id' => $user->id,
                'role_id' => $roleId,
            ]);
        });

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Registrasi berhasil! Silakan masuk menggunakan email dan password.'
            );
    }

    /**
     * Proses logout.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        // Menghapus session lama dan membuat token baru.
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('status', 'Anda telah keluar.');
    }
}