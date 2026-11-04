<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Peminjaman - SIPLUS</title>
</head>
<body>
    <h1>Riwayat Peminjaman Ruangan Anda</h1>
    
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <p><a href="/peminjaman/tambah">+ Ajukan Peminjaman Baru</a> | <a href="/dashboard">Kembali ke Dashboard</a></p>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Ruangan</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Keperluan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjamans as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->ruangan->nama_ruangan ?? 'Ruangan Tidak Ditemukan' }}</td>
                    <td>{{ $p->tanggal_mulai }}</td>
                    <td>{{ $p->tanggal_selesai }}</td>
                    <td>{{ $p->keperluan }}</td>
                    <td><strong>{{ $p->status }}</strong></td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Belum ada riwayat peminjaman ruangan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
@extends('layouts.app')

@section('title', 'Persetujuan Peminjaman')
@section('breadcrumb', 'Status Peminjaman')

@section('content')
<div class="flex flex-wrap items-start justify-between gap-4 mb-5">
    <div>
        <h1 class="text-2xl font-bold">Persetujuan Peminjaman</h1>
        <p class="text-sm text-slate-500">Tinjau pengajuan peminjaman ruangan yang masuk, lalu setujui atau tolak.</p>
    </div>
    <div class="flex gap-2 text-sm">
        @foreach ([null => 'Semua', 'menunggu' => 'Menunggu', 'disetujui' => 'Disetujui', 'ditolak' => 'Ditolak'] as $key => $label)
            <a href="/admin/peminjaman{{ $key ? '?status='.$key : '' }}"
               class="px-3 py-1.5 rounded-full {{ ($status ?? null) === $key ? 'bg-blue-700 text-white' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-100' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>
</div>

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-100 text-[11px] uppercase tracking-wide text-slate-500">
        <tr>
            <th class="text-left px-6 py-3">Peminjam</th>
            <th class="text-left px-6 py-3">Ruangan</th>
            <th class="text-left px-6 py-3">Jadwal</th>
            <th class="text-left px-6 py-3">Keperluan</th>
            <th class="text-center px-6 py-3">Status</th>
            <th class="text-center px-6 py-3">Aksi</th>
        </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
        @forelse ($peminjamans as $p)
            <tr class="hover:bg-slate-50">
                <td class="px-6 py-4">
                    <p class="font-medium">{{ $p->user->name ?? '-' }}</p>
                    <p class="text-xs text-slate-500">{{ $p->user->nim ?? $p->user->nip ?? '' }}</p>
                </td>
                <td class="px-6 py-4">
                    <span class="font-bold text-blue-800">{{ $p->ruangan->kode_ruang ?? '-' }}</span>
                    <span class="block text-xs text-slate-500">{{ $p->ruangan->nama_ruangan ?? '' }}</span>
                </td>
                <td class="px-6 py-4 text-slate-600">
                    {{ $p->tanggal }}<br>
                    <span class="text-xs">{{ $p->jam_mulai }} - {{ $p->jam_selesai }}</span>
                </td>
                <td class="px-6 py-4 text-slate-600">{{ $p->keperluan }}</td>
                <td class="px-6 py-4 text-center">
                    @php
                        $badge = [
                            'menunggu' => 'bg-amber-50 text-amber-700',
                            'disetujui' => 'bg-emerald-50 text-emerald-700',
                            'ditolak' => 'bg-red-50 text-red-600',
                        ][$p->status] ?? 'bg-slate-100 text-slate-600';
                    @endphp
                    <span class="rounded-full text-xs px-3 py-1 {{ $badge }}">{{ ucfirst($p->status) }}</span>
                </td>
                <td class="px-6 py-4">
                    @if ($p->status === 'menunggu')
                        <div class="flex items-center justify-center gap-2">
                            <form method="POST" action="/admin/peminjaman/{{ $p->id }}/status">
                                @csrf
                                <input type="hidden" name="status" value="disetujui">
                                <button class="rounded-lg bg-emerald-600 text-white text-xs font-semibold px-3 py-1.5 hover:bg-emerald-700">Setujui</button>
                            </form>
                            <form method="POST" action="/admin/peminjaman/{{ $p->id }}/status" onsubmit="return confirm('Tolak pengajuan ini?')">
                                @csrf
                                <input type="hidden" name="status" value="ditolak">
                                <button class="rounded-lg bg-red-600 text-white text-xs font-semibold px-3 py-1.5 hover:bg-red-700">Tolak</button>
                            </form>
                        </div>
                    @else
                        <p class="text-center text-xs text-slate-400">Selesai diproses</p>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="px-6 py-10 text-center text-slate-400">Belum ada pengajuan peminjaman.</td></tr>
        @endforelse
        </tbody>
    </table>

    @if ($peminjamans->hasPages())
        <div class="px-6 py-4 border-t border-slate-100">{{ $peminjamans->links() }}</div>
    @endif
</div>
@endsection