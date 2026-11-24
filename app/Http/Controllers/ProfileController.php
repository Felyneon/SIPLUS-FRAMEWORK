<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(): View
    {
        $user = Auth::user();
        $isPengelola = (int) session('user_role') === 1;
        $riwayatPeminjaman = \App\Models\Peminjaman::with('ruangan')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('profile.edit', compact('user', 'isPengelola', 'riwayatPeminjaman'));
    }

    public function kelola(): View
    {
        $user = Auth::user();
        $isPengelola = (int) session('user_role') === 1;

        return view('profile.kelola', compact('user', 'isPengelola'));
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name'  => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'nim'   => ['nullable', 'string', 'max:50'],
        ], [
            'name.required'  => 'Nama lengkap wajib diisi.',
            'name.min'       => 'Nama minimal 3 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email sudah digunakan akun lain.',
        ]);

        if (Schema::hasColumn('users', 'name')) {
            $user->name = $validated['name'];
        }
        if (Schema::hasColumn('users', 'nama')) {
            $user->nama = $validated['name'];
        }

        $user->email = strtolower($validated['email']);

        if (Schema::hasColumn('users', 'nim')) {
            $user->nim = $validated['nim'] !== null && trim($validated['nim']) !== ''
                ? trim($validated['nim'])
                : null;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}