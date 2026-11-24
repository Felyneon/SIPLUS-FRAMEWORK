@extends('layouts.app')

@section('title', 'Kelola Pengguna')
@section('breadcrumb', 'Kelola Pengguna')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-900">Kelola Pengguna</h1>
    <p class="text-sm text-slate-500 mt-1">Cari akun dan ubah peran pengguna sesuai kewenangan.</p>
</div>

<form method="GET" action="{{ route('admin.pengguna.index') }}" class="mb-5 flex max-w-xl gap-2">
    <input type="search" name="q" value="{{ $q }}" placeholder="Cari nama atau email..."
           class="flex-1 rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm">
    <button class="rounded-lg bg-slate-800 px-4 py-2.5 text-sm font-semibold text-white">Cari</button>
</form>

<div class="overflow-x-auto rounded-xl border border-slate-200 bg-white">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-xs uppercase text-slate-500">
            <tr>
                <th class="px-5 py-3 text-left">Pengguna</th>
                <th class="px-5 py-3 text-left">NIM / NIP</th>
                <th class="px-5 py-3 text-left">Peran</th>
                <th class="px-5 py-3 text-left">Ubah Peran</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
        @forelse ($users as $user)
            <tr>
                <td class="px-5 py-4">
                    <p class="font-semibold">{{ $user->name }}</p>
                    <p class="text-xs text-slate-500">{{ $user->email }}</p>
                </td>
                <td class="px-5 py-4 text-slate-600">{{ $user->nim ?: ($user->nip ?: '-') }}</td>
                <td class="px-5 py-4">{{ \App\Models\Role::LABEL[$roleIds[$user->id] ?? $user->roleId()] ?? 'Tidak diketahui' }}</td>
                <td class="px-5 py-4">
                    @if ((int) $user->id === (int) auth()->id())
                        <span class="text-xs text-slate-400">Akun yang sedang digunakan</span>
                    @else
                        <form method="POST" action="{{ route('admin.pengguna.role', $user) }}" class="flex items-center gap-2">
                            @csrf
                            @method('PATCH')
                            <select name="role_id" class="rounded-lg border border-slate-300 px-2 py-2 text-xs">
                                <option value="{{ \App\Models\Role::MAHASISWA }}" @selected(($roleIds[$user->id] ?? $user->roleId()) === \App\Models\Role::MAHASISWA)>Mahasiswa</option>
                                <option value="{{ \App\Models\Role::PENGELOLA }}" @selected(($roleIds[$user->id] ?? $user->roleId()) === \App\Models\Role::PENGELOLA)>Pengelola</option>
                            </select>
                            <button class="rounded-lg bg-blue-700 px-3 py-2 text-xs font-semibold text-white">Simpan</button>
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="4" class="px-5 py-8 text-center text-slate-400">Tidak ada pengguna.</td></tr>
        @endforelse
        </tbody>
    </table>
    @if ($users->hasPages())
        <div class="border-t border-slate-100 px-5 py-4">{{ $users->links() }}</div>
    @endif
</div>
@endsection
