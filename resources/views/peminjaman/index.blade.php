@extends('layouts.app')

@section('title', 'Riwayat Peminjaman')
@section('breadcrumb', 'Riwayat Peminjaman')

@section('content')
<div class="space-y-6">
    <!-- Banner Header -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-slate-950 via-blue-950 to-slate-900 px-6 py-7 sm:px-8 text-white shadow-sm">
        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="text-xs font-medium text-blue-200/80 mb-2">
                    SIPLUS <span class="mx-1.5">&rsaquo;</span> <span class="text-white font-semibold">Status Peminjaman</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">Riwayat Peminjaman Saya</h1>
                <p class="mt-1.5 text-sm text-slate-200/90 leading-relaxed">
                    Pantau status seluruh pengajuan ruang kuliah &amp; kegiatan akademik Anda secara terintegrasi.
                </p>
            </div>

            <a href="{{ route('peminjaman.create') }}"
               class="shrink-0 inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 hover:bg-blue-500 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition">
                <span>+ Ajukan Peminjaman</span>
            </a>
        </div>
    </div>

    <!-- Filter Status -->
    <div class="bg-white border border-slate-200 rounded-2xl p-3 shadow-sm flex flex-wrap items-center gap-2">
        @foreach ([null => 'Semua', 'menunggu' => 'Menunggu', 'disetujui' => 'Disetujui', 'ditolak' => 'Ditolak'] as $key => $label)
            @php
                $targetStatus = match($key) {
                    'menunggu' => 'Pending',
                    'disetujui' => 'Disetujui',
                    'ditolak' => 'Ditolak',
                    default => null,
                };
                $isActive = ($status ?? null) === $targetStatus;
            @endphp
            <a href="{{ route('peminjaman.index', $key ? ['status' => $key] : []) }}"
               class="rounded-xl px-4 py-2 text-xs font-semibold transition {{ $isActive ? 'bg-blue-600 text-white shadow-sm' : 'bg-slate-50 text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    <!-- Tabel Riwayat Peminjaman -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50/90 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="text-left px-5 py-3.5">Ruangan</th>
                        <th class="text-left px-5 py-3.5">Mata Kuliah</th>
                        <th class="text-left px-5 py-3.5">Jadwal</th>
                        <th class="text-left px-5 py-3.5">Keperluan</th>
                        <th class="text-center px-5 py-3.5">Status</th>
                        <th class="text-center px-5 py-3.5">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                @forelse ($peminjamans as $p)
                    @php
                        $statusNormalized = strtolower(trim($p->status ?? ''));
                        $isDisetujui = in_array($statusNormalized, ['disetujui', 'approved'], true);
                        $isDitolak = in_array($statusNormalized, ['ditolak', 'rejected'], true);
                        $statusLabel = $isDisetujui ? 'Disetujui' : ($isDitolak ? 'Ditolak' : 'Menunggu');
                        $badgeStyle = match($statusLabel) {
                            'Disetujui' => 'bg-emerald-50 text-emerald-700 border border-emerald-200/70',
                            'Ditolak' => 'bg-red-50 text-red-700 border border-red-200/70',
                            default => 'bg-amber-50 text-amber-700 border border-amber-200/70',
                        };
                    @endphp
                    <tr class="hover:bg-slate-50/70 transition">
                        <td class="px-5 py-4 align-top">
                            <span class="font-bold text-slate-900">{{ $p->ruangan->kode_ruang ?? '-' }}</span>
                            <span class="block text-xs text-slate-500 mt-0.5">{{ $p->ruangan->nama_ruangan ?? $p->ruangan->nama_ruang ?? 'Ruangan tidak ditemukan' }}</span>
                        </td>
                        <td class="px-5 py-4 align-top">
                            <span class="font-semibold text-slate-800">{{ $p->nama_matkul ?? $p->nama_mata_kuliah ?? '-' }}</span>
                            <span class="block text-xs text-slate-500 mt-0.5">{{ $p->dosen_pengampu ?? '-' }}</span>
                        </td>
                        <td class="px-5 py-4 align-top text-slate-600">
                            @if ($p->tanggal_mulai)
                                <span class="font-medium text-slate-800">{{ $p->tanggal_mulai->format('d/m/Y') }}</span>
                                <span class="block text-xs text-slate-500 mt-0.5">{{ $p->tanggal_mulai->format('H:i') }}&ndash;{{ $p->tanggal_selesai?->format('H:i') }}</span>
                            @elseif ($p->tanggal)
                                <span class="font-medium text-slate-800">{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</span>
                            @else
                                <span class="text-slate-400">-</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 align-top text-slate-600 max-w-xs">
                            {{ $p->keperluan ?? $p->alasan ?? '-' }}
                        </td>
                        <td class="px-5 py-4 align-top text-center">
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $badgeStyle }}">
                                {{ $statusLabel }}
                            </span>
                            @if ($p->alasan_penolakan)
                                <p class="mt-1.5 text-xs text-red-600 leading-snug">{{ $p->alasan_penolakan }}</p>
                            @endif
                        </td>
                        <td class="px-5 py-4 align-top text-center">
                            @if ($p->status === \App\Models\Peminjaman::STATUS_PENDING || $statusNormalized === 'pending' || $statusNormalized === 'menunggu')
                                <form method="POST" action="{{ route('peminjaman.destroy', $p) }}" onsubmit="return confirm('Batalkan pengajuan ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-lg border border-red-200 bg-red-50/60 hover:bg-red-100 px-3 py-1.5 text-xs font-semibold text-red-600 transition cursor-pointer">
                                        Batalkan
                                    </button>
                                </form>
                            @else
                                <span class="text-xs text-slate-400">&mdash;</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="mx-auto w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mb-3">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <p class="text-sm font-bold text-slate-800">Belum ada pengajuan peminjaman.</p>
                            <p class="text-xs text-slate-500 mt-1">Ajukan peminjaman ruangan melalui tombol di kanan atas atau menu Beranda.</p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        @if ($peminjamans->hasPages())
            <div class="px-5 py-4 border-t border-slate-100 bg-slate-50/40">
                {{ $peminjamans->links() }}
            </div>
        @endif
    </div>
</div>
@endsection