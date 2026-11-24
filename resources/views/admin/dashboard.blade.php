@extends('layouts.app')

@section('title', 'Dashboard Pengelola')
@section('breadcrumb', 'Dashboard Pengelola')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-900">Dashboard Pengelola</h1>
    <p class="text-sm text-slate-500 mt-1">Ringkasan pengguna, ruangan, dan pengajuan peminjaman SIPLUS.</p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-4 mb-8">
    @foreach ($ringkasan as $label => $jumlah)
        <div class="rounded-xl border border-slate-200 bg-white p-5">
            <p class="text-sm text-slate-500">{{ ucfirst($label) }}</p>
            <p class="mt-2 text-3xl font-bold text-slate-900">{{ $jumlah }}</p>
        </div>
    @endforeach
</div>

<div class="flex flex-wrap gap-3 mb-6">
    <a href="{{ route('admin.peminjaman.index') }}" class="rounded-lg bg-blue-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-blue-800">Kelola Pengajuan</a>
    <a href="{{ route('ruangan.index') }}" class="rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold hover:bg-slate-50">Daftar Ruangan</a>
    <a href="{{ route('ruangan.create') }}" class="rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold hover:bg-slate-50">Tambah Ruangan</a>
</div>

<div class="overflow-hidden rounded-xl border border-slate-200 bg-white">
    <div class="border-b border-slate-100 px-5 py-4">
        <h2 class="font-semibold text-slate-900">Pengajuan Menunggu Verifikasi</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-5 py-3 text-left">Pemohon</th>
                    <th class="px-5 py-3 text-left">Ruangan</th>
                    <th class="px-5 py-3 text-left">Jadwal</th>
                    <th class="px-5 py-3 text-left">Mata Kuliah</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
            @forelse ($menunggu as $p)
                <tr>
                    <td class="px-5 py-3">{{ $p->user->name ?? '-' }}</td>
                    <td class="px-5 py-3">{{ $p->ruangan->kode_ruang ?? '-' }}</td>
                    <td class="px-5 py-3">{{ $p->tanggal_mulai?->format('d/m/Y H:i') }}–{{ $p->tanggal_selesai?->format('H:i') }}</td>
                    <td class="px-5 py-3">{{ $p->nama_matkul }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-5 py-8 text-center text-slate-400">Tidak ada pengajuan yang menunggu.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
