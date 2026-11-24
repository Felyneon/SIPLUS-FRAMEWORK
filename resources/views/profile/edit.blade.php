@extends('layouts.app')

@section('title', 'Kelola Profil')
@section('breadcrumb', 'Kelola Profil')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Kelola Profil</h1>
        <p class="text-sm text-slate-500 mt-1">Perbarui informasi akun dan foto profil Anda.</p>
    </div>

    @if ($errors->any())
        <div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            <p class="font-semibold mb-1">Periksa kembali data yang dimasukkan:</p>
            <ul class="list-disc pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data"
          class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 space-y-5">
        @csrf
        @method('PUT')

        <div class="flex items-center gap-4">
            @if ($user->profile_photo_path)
                <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($user->profile_photo_path) }}"
                     alt="Foto profil" class="w-20 h-20 rounded-full object-cover border border-slate-200">
            @else
                <div class="w-20 h-20 rounded-full bg-blue-100 text-blue-800 grid place-items-center text-2xl font-bold">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
            @endif
            <div class="flex-1">
                <label for="photo" class="block text-sm font-semibold text-slate-700 mb-1">Foto Profil</label>
                <input id="photo" name="photo" type="file" accept=".jpg,.jpeg,.png,.webp"
                       class="block w-full text-sm text-slate-600 file:mr-3 file:rounded-lg file:border-0 file:bg-blue-50 file:px-3 file:py-2 file:text-blue-700">
                <p class="text-xs text-slate-400 mt-1">JPG, PNG, atau WEBP; maksimal 2 MB.</p>
            </div>
        </div>

        <div>
            <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
            <input id="name" name="name" type="text" required minlength="3" maxlength="100"
                   value="{{ old('name', $user->name) }}"
                   class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
            <input id="email" name="email" type="email" required maxlength="255"
                   value="{{ old('email', $user->email) }}"
                   class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">NIM / NIP</label>
                <input type="text" readonly value="{{ $user->nim ?: ($user->nip ?: '-') }}"
                       class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Peran</label>
                <input type="text" readonly value="{{ ucfirst($user->role ?? 'Pengguna') }}"
                       class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-500">
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-3 border-t border-slate-100">
            <a href="{{ route('dashboard') }}" class="rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50">Kembali</a>
            <button type="submit" class="rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-800">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
