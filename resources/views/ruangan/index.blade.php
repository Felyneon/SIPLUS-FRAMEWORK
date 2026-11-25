@extends('layouts.app')

@section('title', 'Daftar Ruangan')
@section('breadcrumb', 'Ruangan')

@section('content')
<div class="mx-auto w-full max-w-5xl space-y-6">

    <!-- Header Judul & Search Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Daftar Ruangan</h2>
            <p class="text-xs text-gray-500 mt-1">Daftar inventaris ruang kuliah, laboratorium, dan fasilitas Kampus B Dharmawangsa.</p>
        </div>
        <div class="flex items-center space-x-3">
            @if(isset($isPengelola) && $isPengelola)
                <a href="{{ route('ruangan.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-sm transition flex items-center space-x-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    <span>Tambah Ruangan Baru</span>
                </a>
            @endif
            <div class="relative w-full md:w-72">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </span>
                <input type="text" placeholder="Cari ruangan atau gedung..." class="w-full pl-9 pr-4 py-2 bg-white border border-gray-200 rounded-xl text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:border-blue-500 shadow-sm">
            </div>
        </div>
    </div>

    <!-- Tabel Daftar Ruangan dari Database -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/70 border-b border-gray-200 text-[11px] font-bold text-gray-500 uppercase tracking-wider">
                    <th class="py-3.5 px-6">Kode Ruang</th>
                    <th class="py-3.5 px-6">Nama Ruangan</th>
                    <th class="py-3.5 px-6">Gedung & Lantai</th>
                    <th class="py-3.5 px-6">Kapasitas</th>
                    <th class="py-3.5 px-6">Status</th>
                    @if(isset($isPengelola) && $isPengelola)
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-xs text-gray-700 font-medium">
                @forelse($ruangans ?? [] as $r)
                    @php
                        $isTersedia = (strtolower($r->status ?? '') === 'tersedia' || $r->status === \App\Models\Ruangan::STATUS_TERSEDIA);
                    @endphp

                    <!-- Jika mahasiswa klik ruangan yang tersedia, arahkan ke peminjaman.create dengan ruangan_id -->
                    <tr class="hover:bg-blue-50/30 transition {{ (!$isPengelola && $isTersedia) ? 'cursor-pointer' : '' }}"
                        @if(!$isPengelola && $isTersedia) onclick="window.location.href='{{ route('peminjaman.create', ['ruangan_id' => $r->id]) }}'" @endif>

                        <td class="py-4 px-6 font-bold text-blue-600">{{ $r->kode_ruang }}</td>
                        <td class="py-4 px-6 text-gray-900">{{ $r->nama_ruang ?? 'Ruang Kuliah' }}</td>
                        <td class="py-4 px-6 text-gray-500">Gedung {{ $r->gedung ?? 'A' }} • Lantai {{ $r->lantai ?? '1' }}</td>
                        <td class="py-4 px-6 text-gray-600">{{ $r->kapasitas ?? '35' }} Kursi</td>
                        <td class="py-4 px-6">
                            @if(!$isTersedia)
                                <span class="inline-flex items-center bg-red-50 text-red-700 text-[10px] font-bold px-2.5 py-1 rounded-full border border-red-100">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span> Pemeliharaan
                                </span>
                            @else
                                <span class="inline-flex items-center bg-emerald-50 text-emerald-700 text-[10px] font-bold px-2.5 py-1 rounded-full border border-emerald-100">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5"></span> Tersedia / Aktif
                                </span>
                            @endif
                        </td>

                        <!-- KOLOM AKSI: Hanya tampil jika yang login adalah Pengelola -->
                        @if(isset($isPengelola) && $isPengelola)
                            <td class="py-4 px-6 text-right" onclick="event.stopPropagation()">
                                <a href="{{ route('ruangan.edit', $r->id) }}" class="p-1.5 bg-gray-50 hover:bg-blue-100 text-gray-600 hover:text-blue-600 rounded-lg transition inline-flex items-center justify-center border border-gray-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                </a>
                            </td>
                        @endif
                    </tr>
                @empty
                    <!-- Tampilan Kosong Default Jika Belum Ada Ruangan Dibuat Pengelola -->
                    <tr>
                        <td colspan="{{ (isset($isPengelola) && $isPengelola) ? 6 : 5 }}" class="py-16 text-center text-gray-400 text-xs italic">
                            Belum ada data ruangan yang terdaftar di sistem.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection