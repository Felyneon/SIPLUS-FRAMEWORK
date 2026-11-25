@php
    $r = $ruangan ?? null;
    $lokasiVal = old('lokasi', $r->lokasi ?? '');
    preg_match('/^(Gedung [A-Z]).*?(\d+)\s*$/u', $lokasiVal, $m);
    $gedungVal = $m[1] ?? '';
    $lantaiVal = $m[2] ?? '';
    $statusVal = old('status', $r->status ?? 'tersedia');
    $input = 'w-full rounded-lg border border-slate-200 bg-white py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-200';
@endphp

@if ($errors->any())
    <div class="mb-4 rounded-lg bg-red-50 text-red-700 text-sm px-4 py-3">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
    </div>
@endif

{{-- Dikirim ke controller sebagai satu kolom, disusun otomatis oleh script di bawah --}}
<input type="hidden" name="lokasi" id="lokasi" value="{{ $lokasiVal }}">

{{-- Kartu 1: Informasi Ruang --}}
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-5">
    <div class="flex items-center gap-2 font-semibold text-sm text-slate-800">
        <svg class="w-4 h-4 text-blue-700" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M3 21h18M5 21V7l7-4 7 4v14M9 9h1M14 9h1M9 13h1M14 13h1M10 21v-4h4v4"/></svg>
        Informasi Ruang
    </div>
    <p class="text-xs text-slate-500 mt-1 mb-5">Lengkapi lokasi fisik, kode identifikasi unik, serta spesifikasi kapasitas ruangan.</p>

    <div class="space-y-5 max-w-md">
        <div>
            <label class="block text-sm font-semibold mb-1.5">Gedung</label>
            <select id="gedung" required class="{{ $input }} px-3">
                <option value="">Pilih Gedung Kampus B</option>
                @foreach (['Gedung A', 'Gedung B', 'Gedung C'] as $g)
                    <option value="{{ $g }}" @selected($gedungVal === $g)>{{ $g }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-1.5">Lantai</label>
                <input type="number" id="lantai" min="1" required value="{{ $lantaiVal }}" placeholder="1" class="{{ $input }} px-3">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1.5">Kapasitas (kursi)</label>
                <input type="number" name="kapasitas" min="1" required value="{{ old('kapasitas', $r->kapasitas ?? '') }}" placeholder="40" class="{{ $input }} px-3">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-1.5">Kode Ruangan</label>
            <div class="relative">
                <span class="absolute left-3 top-2.5 text-slate-400 text-sm">#</span>
                <input type="text" name="kode_ruang" required value="{{ old('kode_ruang', $r->kode_ruang ?? '') }}" placeholder="Contoh: GA-101" class="{{ $input }} pl-8 pr-3 uppercase placeholder:normal-case">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-1.5">Nama Ruangan</label>
            <div class="relative">
                <svg class="w-4 h-4 absolute left-3 top-3 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M5 21V4a1 1 0 011-1h9a1 1 0 011 1v17M3 21h18M12 12h.01"/></svg>
                <input type="text" name="nama_ruangan" required value="{{ old('nama_ruangan', $r->nama_ruangan ?? '') }}" placeholder="Contoh: Ruang Teori Kuliah 1A" class="{{ $input }} pl-9 pr-3">
            </div>
        </div>
    </div>
</div>

{{-- Kartu 2: Status Operasional --}}
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-5">
    <div class="flex items-center gap-2 font-semibold text-sm text-slate-800">
        <svg class="w-4 h-4 text-blue-700" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="10" rx="5"/><circle cx="8" cy="12" r="2"/></svg>
        Status Operasional Awal
    </div>
    <p class="text-xs text-slate-500 mt-1 mb-4">Tentukan ketersediaan ruangan setelah disimpan ke basis data Sarpras.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <label class="flex gap-3 rounded-xl bg-slate-50 border border-transparent p-4 cursor-pointer has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50">
            <input type="radio" name="status" value="tersedia" class="mt-1 accent-blue-700" @checked($statusVal === 'tersedia')>
            <span>
                <span class="flex items-center gap-1.5 text-sm font-semibold">Siap Digunakan / Tersedia <span class="w-2 h-2 rounded-full bg-emerald-600"></span></span>
                <span class="block text-xs text-slate-500 mt-0.5">Ruangan langsung aktif dan dapat diajukan jadwal perkuliahan atau seminar.</span>
            </span>
        </label>

        <label class="flex gap-3 rounded-xl bg-slate-50 border border-transparent p-4 cursor-pointer has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50">
            <input type="radio" name="status" value="pemeliharaan" class="mt-1 accent-blue-700" @checked($statusVal === 'pemeliharaan')>
            <span>
                <span class="flex items-center gap-1.5 text-sm font-semibold">Pemeliharaan / Perbaikan <span class="w-2 h-2 rounded-full bg-red-500"></span></span>
                <span class="block text-xs text-slate-500 mt-0.5">Ruang ditandai non-aktif sementara untuk renovasi teknis atau kelistrikan.</span>
            </span>
        </label>
    </div>
</div>

{{-- Tombol --}}
<div class="flex justify-end gap-3">
    <a href="/ruangan" class="rounded-lg bg-blue-100 text-blue-800 text-sm font-semibold px-6 py-2.5 hover:bg-blue-200">Batal</a>
    <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-blue-700 text-white text-sm font-semibold px-5 py-2.5 hover:bg-blue-800">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M8 12l3 3 5-6"/></svg>
        Simpan Ruangan
    </button>
</div>

<script>
    (function () {
        const gedung = document.getElementById('gedung');
        const lantai = document.getElementById('lantai');
        const lokasi = document.getElementById('lokasi');

        function susunLokasi() {
            lokasi.value = (gedung.value && lantai.value)
                ? gedung.value + ' \u2022 Lantai ' + lantai.value
                : '';
        }

        gedung.addEventListener('change', susunLokasi);
        lantai.addEventListener('input', susunLokasi);
        gedung.form.addEventListener('submit', susunLokasi);
        susunLokasi();
    })();
</script>