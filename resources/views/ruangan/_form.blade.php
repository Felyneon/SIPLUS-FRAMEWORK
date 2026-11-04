@php $r = $ruangan ?? null; @endphp

@if ($errors->any())
    <div class="mb-4 rounded-lg bg-red-50 text-red-700 text-sm px-4 py-3">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div>
        <label class="block text-sm font-medium mb-1">Kode Ruang</label>
        <input type="text" name="kode_ruang" value="{{ old('kode_ruang', $r->kode_ruang ?? '') }}" placeholder="GA-101"
            class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-200">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Nama Ruangan</label>
        <input type="text" name="nama_ruangan" value="{{ old('nama_ruangan', $r->nama_ruangan ?? '') }}" placeholder="Ruang Teori Kuliah 1A"
            class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-200">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Lokasi (Gedung &amp; Lantai)</label>
        <input type="text" name="lokasi" value="{{ old('lokasi', $r->lokasi ?? '') }}" placeholder="Gedung A • Lantai 1"
            class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-200">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Kapasitas (kursi)</label>
        <input type="number" name="kapasitas" min="1" value="{{ old('kapasitas', $r->kapasitas ?? '') }}"
            class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-200">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Status Ketersediaan</label>
        <select name="status" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-200">
            @foreach (\App\Models\Ruangan::STATUS as $val => $label)
                <option value="{{ $val }}" @selected(old('status', $r->status ?? 'tersedia') === $val)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Deskripsi <span class="text-slate-400 font-normal">(opsional)</span></label>
        <textarea name="deskripsi" rows="3" placeholder="Fasilitas atau catatan ruangan..."
                class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-200">{{ old('deskripsi', $r->deskripsi ?? '') }}</textarea>
    </div>
</div>

<div class="mt-6 flex gap-3">
    <button type="submit" class="rounded-lg bg-blue-700 text-white text-sm font-semibold px-5 py-2.5 hover:bg-blue-800">Simpan</button>
    <a href="/ruangan" class="rounded-lg bg-slate-100 text-sm font-medium px-5 py-2.5 hover:bg-slate-200">Batal</a>
</div>