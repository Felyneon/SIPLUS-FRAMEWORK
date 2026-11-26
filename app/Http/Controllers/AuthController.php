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
        $credentials = $request->safe()->only([
            'email',
            'password',
        ]);

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

        $request->session()->regenerate();

        $user = Auth::user();
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
        $data = $request->safe()->only([
            'name',
            'email',
            'password',
            'role',
            'nim',
            'nip',
        ]);

        $isPengelola = $data['role'] === 'pengelola';

        $roleId = $isPengelola
            ? Role::PENGELOLA
            : Role::MAHASISWA;

        DB::transaction(function () use (
            $data,
            $roleId,
            $isPengelola
        ) {
            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => $data['password'],
                'role'     => $data['role'],

                // Mahasiswa menggunakan NIM.
                // Pengelola menggunakan NIP.
                'nim' => $isPengelola
                    ? null
                    : ($data['nim'] ?? null),

                'nip' => $isPengelola
                    ? ($data['nip'] ?? null)
                    : null,
            ]);

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

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('status', 'Anda telah keluar.');
    }
}
