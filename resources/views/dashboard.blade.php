@extends('layouts.app')

@section('title', 'Beranda')
@section('breadcrumb', 'Beranda')

@section('content')
@php
    $filterTersedia = function ($item) {
        $status = strtolower(trim($item->status ?? ''));
        $isPemeliharaan = str_contains($status, 'pemeliharaan') || in_array($status, ['maintenance', 'tidak tersedia', 'nonaktif'], true);
        $isTersedia = $status === '' || str_contains($status, 'tersedia') || (defined('\App\Models\Ruangan::STATUS_TERSEDIA') && $item->status === \App\Models\Ruangan::STATUS_TERSEDIA);
        return !$isPemeliharaan && $isTersedia;
    };

    $dariController = isset($ruangans) ? collect($ruangans)->filter($filterTersedia) : collect();

    // Jika data dari controller kurang dari 6 (misalnya sudah di-limit 3 di controller), ambil langsung dari model Ruangan
    $sumberRuangan = $dariController->count() >= 6
        ? $dariController
        : \App\Models\Ruangan::orderBy('id', 'asc')->get()->filter($filterTersedia);

    $ruanganTersedia = $sumberRuangan
        ->sortBy('id')
        ->take(6)
        ->values();

    $barisPertama = $ruanganTersedia->slice(0, 3);
    $barisKedua = $ruanganTersedia->slice(3, 3);
@endphp

<div class="space-y-6">
    <!-- Banner Sambutan -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-slate-950 via-blue-950 to-slate-900 px-6 py-7 sm:px-8 text-white shadow-sm">
        <div class="relative z-10 max-w-2xl">
            <div class="text-xs font-medium text-blue-200/80 mb-2">
                SIPLUS <span class="mx-1.5">&rsaquo;</span> <span class="text-white font-semibold">Beranda</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">Selamat Datang di SIPLUS</h1>
            <p class="mt-2 text-sm text-slate-200/90 leading-relaxed">
                Sistem Peminjaman Ruang Kuliah Fakultas Vokasi UNAIR Gedung A, B, &amp; C. Kelola jadwal perkuliahan dan kegiatan akademik secara terintegrasi.
            </p>
        </div>
    </div>

    <!-- Pencarian & Filter Gedung -->
    <div class="bg-white border border-slate-200 rounded-2xl p-3 shadow-sm flex flex-col md:flex-row items-stretch md:items-center gap-3">
        <div class="relative flex-1">
            <span class="pointer-events-none absolute inset-y-0 left-3.5 flex items-center text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z"/>
                </svg>
            </span>
            <input
                id="searchRuangan"
                type="text"
                placeholder="Cari kode ruang, nama ruangan, lokasi, atau kapasitas..."
                class="w-full rounded-xl border border-transparent bg-slate-50/70 py-2.5 pl-10 pr-4 text-sm text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:bg-white focus:outline-none transition"
            >
        </div>

        <div class="flex flex-wrap items-center gap-1.5" id="filterGedungGroup">
            <button type="button" data-gedung="all" class="gedung-btn rounded-xl bg-blue-600 px-3.5 py-2 text-xs font-semibold text-white shadow-sm transition cursor-pointer">
                Semua
            </button>
            <button type="button" data-gedung="a" class="gedung-btn rounded-xl bg-slate-50 px-3.5 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition cursor-pointer">
                Gedung A
            </button>
            <button type="button" data-gedung="b" class="gedung-btn rounded-xl bg-slate-50 px-3.5 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition cursor-pointer">
                Gedung B
            </button>
            <button type="button" data-gedung="c" class="gedung-btn rounded-xl bg-slate-50 px-3.5 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition cursor-pointer">
                Gedung C
            </button>
        </div>
    </div>

    <!-- Daftar Ruangan Tersedia (Maks 6, 2 Baris x 3 Kolom) -->
    <section class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-base sm:text-lg font-bold text-slate-900">Ruangan Tersedia untuk Diajukan</h2>
            <a href="{{ route('ruangan.index') }}" class="text-xs sm:text-sm font-semibold text-blue-600 hover:text-blue-700 inline-flex items-center gap-1">
                <span>Lihat Semua Ruangan</span>
                <span>&rsaquo;</span>
            </a>
        </div>

        @if ($ruanganTersedia->isEmpty())
            <div class="bg-white border border-slate-200 rounded-2xl p-10 text-center">
                <p class="text-sm font-bold text-slate-800">Belum ada ruangan berstatus tersedia.</p>
                <p class="text-xs text-slate-500 mt-1">Semua ruangan sedang dalam status pemeliharaan atau belum ditambahkan.</p>
            </div>
        @else
            <!-- Baris 1 (3 Kelas) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach ($barisPertama as $ruangan)
                    @php
                        $lokasiText = $ruangan->lokasi ?? 'Gedung A · Lantai 1';
                        preg_match('/gedung\s*([a-z0-9]+)/i', $lokasiText, $matchGedung);
                        $gedungKey = strtolower($matchGedung[1] ?? 'a');
                        $namaRuangan = $ruangan->nama_ruangan ?? $ruangan->nama_ruang ?? 'Ruang Kuliah';
                    @endphp
                    <div
                        data-card-ruangan
                        data-gedung="{{ $gedungKey }}"
                        data-search="{{ strtolower(($ruangan->kode_ruang ?? '') . ' ' . $namaRuangan . ' ' . $lokasiText . ' ' . ($ruangan->kapasitas ?? '')) }}"
                        class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm flex flex-col justify-between hover:border-blue-300 transition"
                    >
                        <div>
                            <div class="flex items-center justify-between gap-2 mb-3">
                                <span class="rounded-md bg-blue-50 px-2.5 py-1 text-[11px] font-bold uppercase text-blue-600">
                                    {{ $ruangan->kode_ruang ?? ('GEDUNG ' . strtoupper($gedungKey)) }}
                                </span>
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600">
                                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                    Tersedia
                                </span>
                            </div>
                            <h3 class="text-base font-bold text-slate-900">
                                {{ $namaRuangan }}
                            </h3>
                            <p class="mt-1 text-xs font-medium text-slate-500">
                                {{ $lokasiText }}
                            </p>
                            <p class="mt-1.5 text-xs text-slate-500 leading-relaxed">
                                Kapasitas {{ $ruangan->kapasitas ?? '-' }} Kursi
                            </p>
                        </div>

                        <a
                            href="{{ route('peminjaman.create', ['ruangan_id' => $ruangan->id]) }}"
                            class="mt-5 w-full rounded-xl bg-blue-600 hover:bg-blue-700 px-4 py-2.5 text-center text-xs font-semibold text-white transition inline-flex items-center justify-center gap-1.5"
                        >
                            <span>Ajukan Pinjam</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Baris 2 (Lanjutan di Bawah: 2 Ruangan Tersisa Jika Total 5) -->
            @if ($barisKedua->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach ($barisKedua as $ruangan)
                        @php
                            $lokasiText = $ruangan->lokasi ?? 'Gedung A · Lantai 1';
                            preg_match('/gedung\s*([a-z0-9]+)/i', $lokasiText, $matchGedung);
                            $gedungKey = strtolower($matchGedung[1] ?? 'a');
                            $namaRuangan = $ruangan->nama_ruangan ?? $ruangan->nama_ruang ?? 'Ruang Kuliah';
                        @endphp
                        <div
                            data-card-ruangan
                            data-gedung="{{ $gedungKey }}"
                            data-search="{{ strtolower(($ruangan->kode_ruang ?? '') . ' ' . $namaRuangan . ' ' . $lokasiText . ' ' . ($ruangan->kapasitas ?? '')) }}"
                            class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm flex flex-col justify-between hover:border-blue-300 transition"
                        >
                            <div>
                                <div class="flex items-center justify-between gap-2 mb-3">
                                    <span class="rounded-md bg-blue-50 px-2.5 py-1 text-[11px] font-bold uppercase text-blue-600">
                                        {{ $ruangan->kode_ruang ?? ('GEDUNG ' . strtoupper($gedungKey)) }}
                                    </span>
                                    <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600">
                                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                        Tersedia
                                    </span>
                                </div>
                                <h3 class="text-base font-bold text-slate-900">
                                    {{ $namaRuangan }}
                                </h3>
                                <p class="mt-1 text-xs font-medium text-slate-500">
                                    {{ $lokasiText }}
                                </p>
                                <p class="mt-1.5 text-xs text-slate-500 leading-relaxed">
                                    Kapasitas {{ $ruangan->kapasitas ?? '-' }} Kursi
                                </p>
                            </div>

                            <a
                                href="{{ route('peminjaman.create', ['ruangan_id' => $ruangan->id]) }}"
                                class="mt-5 w-full rounded-xl bg-blue-600 hover:bg-blue-700 px-4 py-2.5 text-center text-xs font-semibold text-white transition inline-flex items-center justify-center gap-1.5"
                            >
                                <span>Ajukan Pinjam</span>
                                <span>&rarr;</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
    </section>
</div>

<script>
    (function () {
        const searchInput = document.getElementById('searchRuangan');
        const buttons = document.querySelectorAll('.gedung-btn');
        const cards = document.querySelectorAll('[data-card-ruangan]');
        let activeGedung = 'all';

        function filterCards() {
            const keyword = (searchInput?.value || '').trim().toLowerCase();

            cards.forEach((card) => {
                const gedung = (card.getAttribute('data-gedung') || '').toLowerCase();
                const searchText = (card.getAttribute('data-search') || '').toLowerCase();

                const matchGedung = activeGedung === 'all' || gedung === activeGedung;
                const matchKeyword = !keyword || searchText.includes(keyword);

                card.classList.toggle('hidden', !(matchGedung && matchKeyword));
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

                filterCards();
            });
        });

        searchInput?.addEventListener('input', filterCards);
    })();
</script>
@endsection