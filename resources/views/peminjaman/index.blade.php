@extends('layouts.app')

@section('title', 'Riwayat Peminjaman')
@section('breadcrumb', 'Riwayat Peminjaman')

@section('content')
<div class="flex flex-wrap items-start justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Riwayat Peminjaman Saya</h1>
        <p class="text-sm text-slate-500 mt-1">Pantau status seluruh pengajuan ruangan Anda.</p>
    </div>
    <a href="{{ route('peminjaman.create') }}" class="rounded-lg bg-blue-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-blue-800">+ Ajukan Peminjaman</a>
</div>

<div class="flex flex-wrap gap-2 mb-4 text-sm">
    @foreach ([null => 'Semua', 'menunggu' => 'Menunggu', 'disetujui' => 'Disetujui', 'ditolak' => 'Ditolak'] as $key => $label)
        <a href="{{ route('peminjaman.index', $key ? ['status' => $key] : []) }}"
           class="rounded-full px-3 py-1.5 {{ ($status ?? null) === match($key) { 'menunggu' => 'Pending', 'disetujui' => 'Disetujui', 'ditolak' => 'Ditolak', default => null } ? 'bg-blue-700 text-white' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-100' }}">
            {{ $label }}
        </a>
    @endforeach
</div>

<div class="bg-white border border-slate-200 rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-100 text-xs uppercase text-slate-500">
                <tr>
                    <th class="text-left px-5 py-3">Ruangan</th>
                    <th class="text-left px-5 py-3">Mata Kuliah</th>
                    <th class="text-left px-5 py-3">Jadwal</th>
                    <th class="text-left px-5 py-3">Keperluan</th>
                    <th class="text-center px-5 py-3">Status</th>
                    <th class="text-center px-5 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
            @forelse ($peminjamans as $p)
                <tr>
                    <td class="px-5 py-4">
                        <span class="font-semibold text-blue-800">{{ $p->ruangan->kode_ruang ?? '-' }}</span>
                        <span class="block text-xs text-slate-500">{{ $p->ruangan->nama_ruangan ?? 'Ruangan tidak ditemukan' }}</span>
                    </td>
                    <td class="px-5 py-4">
                        <span class="font-medium">{{ $p->nama_matkul }}</span>
                        <span class="block text-xs text-slate-500">{{ $p->dosen_pengampu }}</span>
                    </td>
                    <td class="px-5 py-4 text-slate-600">
                        {{ $p->tanggal_mulai?->format('d/m/Y') }}
                        <span class="block text-xs">{{ $p->tanggal_mulai?->format('H:i') }}–{{ $p->tanggal_selesai?->format('H:i') }}</span>
                    </td>
                    <td class="px-5 py-4 text-slate-600">{{ $p->keperluan }}</td>
                    <td class="px-5 py-4 text-center">
                        @php
                            $badge = match($p->status) {
                                'Pending' => 'bg-amber-50 text-amber-700',
                                'Disetujui' => 'bg-emerald-50 text-emerald-700',
                                'Ditolak' => 'bg-red-50 text-red-700',
                                default => 'bg-slate-100 text-slate-600',
                            };
                        @endphp
                        <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $badge }}">{{ $p->status }}</span>
                        @if ($p->alasan_penolakan)
                            <p class="mt-1 text-xs text-red-600">{{ $p->alasan_penolakan }}</p>
                        @endif
                    </td>
                    <td class="px-5 py-4 text-center">
                        @if ($p->status === \App\Models\Peminjaman::STATUS_PENDING)
                            <form method="POST" action="{{ route('peminjaman.destroy', $p) }}" onsubmit="return confirm('Batalkan pengajuan ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-xs font-semibold text-red-600 hover:underline">Batalkan</button>
                            </form>
                        @else
                            <span class="text-xs text-slate-400">—</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-5 py-10 text-center text-slate-400">Belum ada pengajuan peminjaman.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if ($peminjamans->hasPages())
        <div class="px-5 py-4 border-t border-slate-100">{{ $peminjamans->links() }}</div>
    @endif
</div>
@endsection
