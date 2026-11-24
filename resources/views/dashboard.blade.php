@extends('layouts.app')

@section('title', 'Beranda')
@section('breadcrumb', 'Beranda')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-900">Selamat datang, {{ auth()->user()->name }}</h1>
    <p class="text-sm text-slate-500 mt-1">{{ $isPengelola ? 'Ringkasan pengelolaan peminjaman dan ruangan.' : 'Ringkasan aktivitas peminjaman ruangan Anda.' }}</p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-8">
    @foreach ($ringkasan as $label => $jumlah)
        <div class="bg-white border border-slate-200 rounded-xl p-5">
            <p class="text-sm text-slate-500">{{ ucfirst(str_replace('_', ' ', $label)) }}</p>
            <p class="text-3xl font-bold text-slate-900 mt-2">{{ $jumlah }}</p>
        </div>
    @endforeach
</div>

<div class="flex flex-wrap gap-3 mb-6">
    <a href="{{ route('ruangan.index') }}" class="rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold hover:bg-slate-50">Lihat Daftar Ruangan</a>
    @if ($isPengelola)
        <a href="{{ route('admin.peminjaman.index') }}" class="rounded-lg bg-blue-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-blue-800">Periksa Pengajuan</a>
    @else
        <a href="{{ route('peminjaman.create') }}" class="rounded-lg bg-blue-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-blue-800">Ajukan Peminjaman</a>
        <a href="{{ route('peminjaman.index') }}" class="rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold hover:bg-slate-50">Riwayat Saya</a>
    @endif
</div>

<div class="bg-white border border-slate-200 rounded-xl overflow-hidden">
    <div class="px-5 py-4 border-b border-slate-100">
        <h2 class="font-semibold text-slate-900">{{ $isPengelola ? 'Pengajuan Menunggu' : 'Peminjaman Terbaru' }}</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                <tr>
                    @if ($isPengelola)<th class="text-left px-5 py-3">Pemohon</th>@endif
                    <th class="text-left px-5 py-3">Ruangan</th>
                    <th class="text-left px-5 py-3">Jadwal</th>
                    <th class="text-left px-5 py-3">Mata Kuliah</th>
                    <th class="text-left px-5 py-3">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
            @forelse ($terbaru as $p)
                <tr>
                    @if ($isPengelola)<td class="px-5 py-3">{{ $p->user->name ?? '-' }}</td>@endif
                    <td class="px-5 py-3">{{ $p->ruangan->kode_ruang ?? '-' }}</td>
                    <td class="px-5 py-3">{{ $p->tanggal_mulai?->format('d/m/Y H:i') }} – {{ $p->tanggal_selesai?->format('H:i') }}</td>
                    <td class="px-5 py-3">{{ $p->nama_matkul }}</td>
                    <td class="px-5 py-3">{{ $p->status }}</td>
                </tr>
            @empty
                <tr><td colspan="{{ $isPengelola ? 5 : 4 }}" class="px-5 py-8 text-center text-slate-400">Belum ada aktivitas peminjaman.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
