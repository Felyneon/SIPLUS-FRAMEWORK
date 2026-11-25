@extends('layouts.app')

@section('title', 'Kelola Profil')
@section('breadcrumb', 'Kelola Profil')

@section('content')
@php
    $profilUser = $user ?? auth()->user();
    $namaLengkap = $profilUser->nama ?? $profilUser->name ?? 'Pengguna';
    $nimNip = $profilUser->nim ?? $profilUser->nip ?? '';

    $updateProfileUrl = \Illuminate\Support\Facades\Route::has('profile.update')
        ? route('profile.update')
        : (\Illuminate\Support\Facades\Route::has('profil.update') ? route('profil.update') : url('/profile'));

    $backProfilUrl = \Illuminate\Support\Facades\Route::has('profile.edit')
        ? route('profile.edit')
        : url('/profile');
@endphp

<div class="space-y-6">
    @if ($errors->any())
        <div class="rounded-2xl border border-red-200 bg-red-50 px-5 py-3.5 text-sm text-red-700">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Banner Header -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-slate-950 via-blue-950 to-slate-900 px-6 py-7 sm:px-8 text-white shadow-sm">
        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="text-xs font-medium text-blue-200/80 mb-1">
                    SIPLUS <span class="mx-1.5">&rsaquo;</span>
                    <a href="{{ $backProfilUrl }}" class="hover:text-white transition">Profil Saya</a>
                    <span class="mx-1.5">&rsaquo;</span>
                    <span class="text-white font-semibold">Kelola Profil</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">Kelola Profil</h1>
                <p class="text-xs sm:text-sm text-slate-200/90 mt-1">
                    Perbarui informasi akun Anda.
                </p>
            </div>

            <a href="{{ $backProfilUrl }}"
               class="shrink-0 inline-flex items-center justify-center gap-2 rounded-xl bg-white/10 hover:bg-white/20 border border-white/15 px-4 py-2 text-xs font-semibold text-white transition">
                <span>&larr; Kembali ke Profil</span>
            </a>
        </div>
    </div>

    <!-- Form Kelola Profil -->
    <div class="bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 shadow-sm max-w-4xl">
        <form method="POST" action="{{ $updateProfileUrl }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-semibold text-slate-800 mb-1.5">Nama Lengkap</label>
                <input id="name"
                       name="name"
                       type="text"
                       value="{{ old('name', $namaLengkap) }}"
                       class="w-full rounded-xl border border-slate-200 bg-slate-50/70 px-4 py-2.5 text-sm text-slate-900 focus:border-blue-500 focus:bg-white focus:outline-none transition">
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-slate-800 mb-1.5">Email</label>
                <input id="email"
                       name="email"
                       type="email"
                       value="{{ old('email', $profilUser->email ?? '') }}"
                       class="w-full rounded-xl border border-slate-200 bg-slate-50/70 px-4 py-2.5 text-sm text-slate-900 focus:border-blue-500 focus:bg-white focus:outline-none transition">
            </div>

            <div>
                <label for="nim" class="block text-sm font-semibold text-slate-800 mb-1.5">NIM / NIP</label>
                <input id="nim"
                       name="nim"
                       type="text"
                       value="{{ old('nim', $nimNip) }}"
                       placeholder="Masukkan NIM atau NIP"
                       class="w-full rounded-xl border border-slate-200 bg-slate-50/70 px-4 py-2.5 text-sm text-slate-900 focus:border-blue-500 focus:bg-white focus:outline-none transition">
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ $backProfilUrl }}"
                   class="rounded-xl border border-slate-200 bg-white hover:bg-slate-50 px-4 py-2.5 text-xs font-semibold text-slate-700 transition">
                    Kembali
                </a>
                <button type="submit"
                        class="rounded-xl bg-blue-600 hover:bg-blue-700 px-5 py-2.5 text-xs font-semibold text-white shadow-sm transition cursor-pointer">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection