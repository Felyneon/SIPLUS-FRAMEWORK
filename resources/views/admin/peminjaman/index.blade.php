@extends('layouts.app')

@section('title', 'Persetujuan Peminjaman')
@section('breadcrumb', 'Persetujuan Peminjaman')

@section('content')
@if ($errors->any())
    <div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
        <ul class="list-disc pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
@endif
<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-900">Persetujuan Peminjaman</h1>
    <p class="text-sm text-slate-500 mt-1">Periksa jadwal dan data pengajuan sebelum menyetujui atau menolaknya.</p>
</div>

<div class="flex flex-wrap gap-2 mb-4 text-sm">
    @foreach ([null => 'Semua', 'menunggu' => 'Menunggu', 'disetujui' => 'Disetujui', 'ditolak' => 'Ditolak'] as $key => $label)
        <a href="{{ route('admin.peminjaman.index', $key ? ['status' => $key] : []) }}"
           class="rounded-full px-3 py-1.5 {{ ($status ?? null) === match($key) { 'menunggu' => 'Pending', 'disetujui' => 'Disetujui', 'ditolak' => 'Ditolak', default => null } ? 'bg-blue-700 text-white' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-100' }}">
            {{ $label }}@if($key === 'menunggu') ({{ $ringkasan['Pending'] ?? 0 }})@endif
        </a>
    @endforeach
</div>

<div class="bg-white border border-slate-200 rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-100 text-xs uppercase text-slate-500">
                <tr>
                    <th class="text-left px-5 py-3">Pemohon</th>
                    <th class="text-left px-5 py-3">Ruangan</th>
                    <th class="text-left px-5 py-3">Akademik</th>
                    <th class="text-left px-5 py-3">Jadwal</th>
                    <th class="text-left px-5 py-3">Keperluan</th>
                    <th class="text-center px-5 py-3">Status</th>
                    <th class="text-center px-5 py-3">Tindakan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
            @forelse ($peminjamans as $p)
                <tr class="align-top">
                    <td class="px-5 py-4">
                        <p class="font-semibold">{{ $p->user->name ?? '-' }}</p>
                        <p class="text-xs text-slate-500">{{ $p->user->nim ?? $p->user->nip ?? $p->user->email ?? '' }}</p>
                    </td>
                    <td class="px-5 py-4">
                        <p class="font-semibold text-blue-800">{{ $p->ruangan->kode_ruang ?? '-' }}</p>
                        <p class="text-xs text-slate-500">{{ $p->ruangan->nama_ruangan ?? '-' }}</p>
                    </td>
                    <td class="px-5 py-4">
                        <p class="font-medium">{{ $p->nama_matkul }}</p>
                        <p class="text-xs text-slate-500">{{ $p->dosen_pengampu }}</p>
                        <p class="text-xs text-slate-500">{{ $p->prodi }}</p>
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap">
                        {{ $p->tanggal_mulai?->format('d/m/Y') }}
                        <p class="text-xs text-slate-500">{{ $p->tanggal_mulai?->format('H:i') }}–{{ $p->tanggal_selesai?->format('H:i') }}</p>
                    </td>
                    <td class="px-5 py-4 max-w-xs text-slate-600">{{ $p->keperluan }}</td>
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
                        @if($p->alasan_penolakan)
                            <p class="mt-1 text-xs text-red-600">{{ $p->alasan_penolakan }}</p>
                        @endif
                    </td>
                    <td class="px-5 py-4">
                        @if ($p->status === \App\Models\Peminjaman::STATUS_PENDING)
                            <div class="flex flex-col gap-2 min-w-36">
                                <form method="POST" action="{{ route('admin.peminjaman.status', $p) }}">
                                    @csrf
                                    <input type="hidden" name="status" value="Disetujui">
                                    <button class="w-full rounded-lg bg-emerald-600 px-3 py-2 text-xs font-semibold text-white hover:bg-emerald-700">Setujui</button>
                                </form>
                                <form method="POST" action="{{ route('admin.peminjaman.status', $p) }}" onsubmit="return confirm('Tolak pengajuan ini?')">
                                    @csrf
                                    <input type="hidden" name="status" value="Ditolak">
                                    <textarea name="alasan_penolakan" required maxlength="500" rows="2" placeholder="Alasan penolakan..." class="w-full rounded-lg border border-slate-300 p-2 text-xs mb-1"></textarea>
                                    <button class="w-full rounded-lg bg-red-600 px-3 py-2 text-xs font-semibold text-white hover:bg-red-700">Tolak</button>
                                </form>
                            </div>
                        @else
                            <span class="text-xs text-slate-400">Sudah diproses</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="px-5 py-10 text-center text-slate-400">Belum ada pengajuan peminjaman.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if ($peminjamans->hasPages())
        <div class="px-5 py-4 border-t border-slate-100">{{ $peminjamans->links() }}</div>
    @endif
</div>
@endsection
