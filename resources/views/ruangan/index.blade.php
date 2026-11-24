@extends('layouts.app')

@section('title', 'Daftar Ruangan')
@section('breadcrumb', 'Ruangan')

@section('content')
<!-- Bagian Isi Utama / Form -->
        <div class="mx-auto w-full max-w-5xl">
            
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                    <span class="text-blue-600">➕</span> Tambah Ruangan Baru
                </h2>
                <p class="text-xs text-gray-500 mt-0.5">Masukkan data inventaris ruang kuliah atau laboratorium Kampus B (Gedung A, B, C).</p>
            </div>

            <form action="{{ route('ruangan.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- CARD 1: INFORMASI RUANG -->
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                    <div class="flex items-center space-x-2 mb-4 pb-3 border-b border-gray-100">
                        <span class="text-blue-600">🏢</span>
                        <h3 class="font-bold text-gray-900 text-sm">Informasi Ruang</h3>
                    </div>
                    <p class="text-xs text-gray-500 mb-6">Lengkapi lokasi fisik, kode identifikasi unik, serta spesifikasi kapasitas ruangan.</p>

                    <div class="space-y-4">
                        <!-- Gedung -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1.5">Gedung</label>
                            <div class="relative">
                                <select name="gedung" class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs text-gray-700 focus:outline-none focus:border-blue-500 appearance-none shadow-sm">
                                    <option value="" disabled selected>Pilih Gedung Kampus B</option>
                                    <option value="Gedung A">Gedung A</option>
                                    <option value="Gedung B">Gedung B</option>
                                    <option value="Gedung C">Gedung C</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Kode Ruangan -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1.5">Kode Ruangan</label>
                            <input type="text" name="kode_ruang" placeholder="Contoh: GA-101" class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:border-blue-500 shadow-sm">
                        </div>

                        <!-- Nama Ruangan -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1.5">Nama Ruangan</label>
                            <input type="text" name="nama_ruangan" placeholder="Contoh: Ruang Teori Kuliah 1A" class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:border-blue-500 shadow-sm">
                        </div>

                        <!-- Kapasitas Ruangan -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1.5">Kapasitas (Jumlah Kursi)</label>
                            <input type="number" name="kapasitas" placeholder="Contoh: 40" class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:border-blue-500 shadow-sm">
                        </div>
                    </div>
                </div>

                <!-- CARD 2: STATUS OPERASIONAL AWAL -->
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                    <div class="flex items-center space-x-2 mb-4 pb-3 border-b border-gray-100">
                        <span class="text-blue-600">🔘</span>
                        <h3 class="font-bold text-gray-900 text-sm">Status Operasional Awal</h3>
                    </div>
                    <p class="text-xs text-gray-500 mb-6">Tentukan ketersediaan ruangan setelah disimpan ke basis data Sarpras.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Opsi 1: Tersedia -->
                        <label class="relative flex items-start p-4 border border-gray-200 rounded-xl cursor-pointer hover:border-blue-500 transition bg-white shadow-sm">
                            <div class="flex items-center h-5">
                                <input type="radio" name="status" value="aktif" checked class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                            </div>
                            <div class="ml-3 text-xs">
                                <span class="font-bold text-gray-900 flex items-center">
                                    Siap Digunakan / Tersedia <span class="w-1.5 h-1.5 ml-1.5 bg-emerald-500 rounded-full"></span>
                                </span>
                                <p class="text-gray-500 mt-1">Ruangan langsung aktif dan dapat diajukan jadwal perkuliahan atau seminar.</p>
                            </div>
                        </label>

                        <!-- Opsi 2: Pemeliharaan -->
                        <label class="relative flex items-start p-4 border border-gray-200 rounded-xl cursor-pointer hover:border-rose-500 transition bg-white shadow-sm">
                            <div class="flex items-center h-5">
                                <input type="radio" name="status" value="pemeliharaan" class="h-4 w-4 text-rose-600 border-gray-300 focus:ring-rose-500">
                            </div>
                            <div class="ml-3 text-xs">
                                <span class="font-bold text-gray-900 flex items-center">
                                    Pemeliharaan / Perbaikan <span class="w-1.5 h-1.5 ml-1.5 bg-rose-500 rounded-full"></span>
                                </span>
                                <p class="text-gray-500 mt-1">Ruang ditandai non-aktif sementara untuk renovasi teknis atau kelistrikan.</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- TOMBOL AKSI -->
                <div class="flex items-center justify-end space-x-3 pt-2">
                    <a href="{{ url('/ruangan') }}" class="px-5 py-2.5 border border-gray-200 rounded-lg text-xs font-bold text-gray-600 bg-blue-50 hover:bg-blue-100 transition shadow-sm">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-blue-700 hover:bg-blue-800 text-white rounded-lg text-xs font-bold shadow-sm transition flex items-center space-x-2">
                        <span>✓ Simpan Ruangan</span>
                    </button>
                </div>

            </form>

        </div>
@endsection
