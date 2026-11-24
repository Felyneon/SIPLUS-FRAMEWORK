@extends('layouts.app')

@section('title', 'Daftar Ruangan')
@section('breadcrumb', 'Ruangan')

@section('content')
<div class="space-y-6">
    <!-- Banner Header -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-slate-950 via-blue-950 to-slate-900 px-6 py-7 sm:px-8 text-white shadow-sm">
        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="text-xs font-medium text-blue-200/80 mb-2">
                    SIPLUS <span class="mx-1.5">&rsaquo;</span> <span class="text-white font-semibold">Ruangan</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">Daftar Ruangan</h1>
                <p class="mt-1.5 text-sm text-slate-200/90 leading-relaxed">
                    Daftar inventaris ruang kuliah, laboratorium, dan fasilitas Kampus B Dharmawangsa.
                </p>
            </div>

            @if(isset($isPengelola) && $isPengelola)
                <a href="{{ route('ruangan.create') }}"
                   class="shrink-0 inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 hover:bg-blue-500 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Tambah Ruangan Baru</span>
                </a>
            @endif
        </div>
    </div>

    <!-- Bilah Pencarian & Filter Gedung -->
    <div class="bg-white border border-slate-200 rounded-2xl p-3 shadow-sm flex flex-col md:flex-row items-stretch md:items-center gap-3">
        <div class="relative flex-1">
            <span class="pointer-events-none absolute inset-y-0 left-3.5 flex items-center text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z"/>
                </svg>
            </span>
            <input
                id="searchDaftarRuangan"
                type="text"
                placeholder="Cari kode ruang, nama ruangan, atau lokasi..."
                class="w-full rounded-xl border border-transparent bg-slate-50/70 py-2.5 pl-10 pr-4 text-sm text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:bg-white focus:outline-none transition"
            >
        </div>

        <div class="flex flex-wrap items-center gap-1.5" id="filterGedungRuangan">
            <button type="button" data-gedung="all" class="ruangan-gedung-btn rounded-xl bg-blue-600 px-3.5 py-2 text-xs font-semibold text-white shadow-sm transition cursor-pointer">
                Semua
            </button>
            <button type="button" data-gedung="a" class="ruangan-gedung-btn rounded-xl bg-slate-50 px-3.5 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition cursor-pointer">
                Gedung A
            </button>
            <button type="button" data-gedung="b" class="ruangan-gedung-btn rounded-xl bg-slate-50 px-3.5 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition cursor-pointer">
                Gedung B
            </button>
            <button type="button" data-gedung="c" class="ruangan-gedung-btn rounded-xl bg-slate-50 px-3.5 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition cursor-pointer">
                Gedung C
            </button>
        </div>
    </div>

    <!-- Tabel Daftar Ruangan -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50/90 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="text-left px-6 py-3.5">Kode Ruang</th>
                        <th class="text-left px-6 py-3.5">Nama Ruangan</th>
                        <th class="text-left px-6 py-3.5">Gedung &amp; Lantai</th>
                        <th class="text-left px-6 py-3.5">Kapasitas</th>
                        <th class="text-left px-6 py-3.5">Status</th>
                        @if(isset($isPengelola) && $isPengelola)
                            <th class="text-right px-6 py-3.5">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($ruangans ?? [] as $r)
                        @php
                            $isTersedia = (strtolower($r->status ?? '') === 'tersedia' || $r->status === \App\Models\Ruangan::STATUS_TERSEDIA);
                            $lokasiText = $r->lokasi ?? trim('Gedung ' . ($r->gedung ?? 'A') . ' · Lantai ' . ($r->lantai ?? '1'));

                            preg_match('/gedung\s*([a-z0-9]+)/i', $lokasiText, $matchGedung);
                            $gedungKey = strtolower($matchGedung[1] ?? ($r->gedung ?? 'a'));
                            $gedungKey = str_replace('gedung ', '', $gedungKey);

                            $namaRuangan = $r->nama_ruangan ?? $r->nama_ruang ?? 'Ruang Kuliah';
                        @endphp

                        <tr data-row-ruangan
                            data-gedung="{{ $gedungKey }}"
                            data-search="{{ strtolower(($r->kode_ruang ?? '') . ' ' . $namaRuangan . ' ' . $lokasiText) }}"
                            class="hover:bg-blue-50/40 transition {{ (!$isPengelola && $isTersedia) ? 'cursor-pointer' : '' }}"
                            @if(!$isPengelola && $isTersedia) onclick="window.location.href='{{ route('peminjaman.create', ['ruangan_id' => $r->id]) }}'" @endif>

                            <td class="py-4 px-6 font-bold text-blue-600">
                                {{ $r->kode_ruang }}
                            </td>
                            <td class="py-4 px-6 font-semibold text-slate-900">
                                {{ $namaRuangan }}
                            </td>
                            <td class="py-4 px-6 text-slate-500">
                                {{ $lokasiText }}
                            </td>
                            <td class="py-4 px-6 text-slate-600">
                                {{ $r->kapasitas ?? '35' }} Kursi
                            </td>
                            <td class="py-4 px-6">
                                @if(!$isTersedia)
                                    <span class="inline-flex items-center rounded-full bg-red-50 border border-red-200/70 px-3 py-1 text-xs font-semibold text-red-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1.5"></span> Pemeliharaan
                                    </span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-emerald-50 border border-emerald-200/70 px-3 py-1 text-xs font-semibold text-emerald-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span> Tersedia / Aktif
                                    </span>
                                @endif
                            </td>

                            @if(isset($isPengelola) && $isPengelola)
                                <td class="py-4 px-6 text-right" onclick="event.stopPropagation()">
                                    <a href="{{ route('ruangan.edit', $r->id) }}"
                                       title="Edit Ruangan"
                                       class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-slate-50 hover:bg-blue-50 hover:border-blue-200 p-2 text-slate-600 hover:text-blue-600 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </a>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ (isset($isPengelola) && $isPengelola) ? 6 : 5 }}" class="px-6 py-16 text-center">
                                <div class="mx-auto w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mb-3">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                </div>
                                <p class="text-sm font-bold text-slate-800">Belum ada data ruangan yang terdaftar di sistem.</p>
                                <p class="text-xs text-slate-500 mt-1">Data ruangan akan tampil di sini setelah ditambahkan oleh pengelola.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    (function () {
        const searchInput = document.getElementById('searchDaftarRuangan');
        const buttons = document.querySelectorAll('.ruangan-gedung-btn');
        const rows = document.querySelectorAll('[data-row-ruangan]');
        let activeGedung = 'all';

        function filterRows() {
            const keyword = (searchInput?.value || '').trim().toLowerCase();

            rows.forEach((row) => {
                const gedung = (row.getAttribute('data-gedung') || '').toLowerCase();
                const searchText = (row.getAttribute('data-search') || '').toLowerCase();

                const matchGedung = activeGedung === 'all' || gedung === activeGedung;
                const matchKeyword = !keyword || searchText.includes(keyword);

                row.classList.toggle('hidden', !(matchGedung && matchKeyword));
            });
        }

        buttons.forEach((btn) => {
            btn.addEventListener('click', () => {
                activeGedung = btn.getAttribute('data-gedung') || 'all';

                buttons.forEach((b) => {
                    const isActive = b === btn;
                    b.classList.toggle('bg-blue-600', isActive);
                    b.classList.toggle('text-white', isActive);
                    b.classList.toggle('shadow-sm', isActive);
                    b.classList.toggle('bg-slate-50', !isActive);
                    b.classList.toggle('text-slate-600', !isActive);
                    b.classList.toggle('hover:bg-slate-100', !isActive);
                });

                filterRows();
            });
        });

        searchInput?.addEventListener('input', filterRows);
    })();
</script>
@endsection