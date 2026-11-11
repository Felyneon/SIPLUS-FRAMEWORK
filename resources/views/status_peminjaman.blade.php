<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Peminjaman & Penentuan Jam Pinjam - SIPLUS</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 flex h-screen overflow-hidden">

    <!-- SIDEBAR KIRI -->
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between hidden md:flex">
        <div>
            <!-- Logo & Brand -->
            <div class="p-6 pb-4">
                <div class="text-xs text-gray-400 font-medium tracking-wide mb-1">STATUS SIPLUS</div>
                <div class="flex items-center space-x-3 mt-2">
                    <div class="w-9 h-9 bg-blue-50 border border-blue-100 rounded-lg flex items-center justify-center text-blue-600 font-bold shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-900 leading-tight">SIPLUS</h1>
                        <p class="text-[11px] text-gray-500">Fakultas Vokasi UNAIR</p>
                    </div>
                </div>
            </div>

            <!-- Menu Utama -->
            <div class="px-4 py-2">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider px-3 mb-2">MENU UTAMA</p>
                <nav class="space-y-1">
                    <a href="{{ url('/dashboard') }}" class="flex items-center px-3 py-2.5 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 transition">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Beranda
                    </a>
                    <a href="{{ url('/peminjaman') }}" class="flex items-center px-3 py-2.5 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg transition">
                        <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        Status Peminjaman
                    </a>
                    <a href="{{ url('/ruangan') }}" class="flex items-center px-3 py-2.5 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 transition">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        Ruangan
                    </a>
                    <a href="{{ url('/ruangan/create') }}" class="flex items-center px-3 py-2.5 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 transition">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        Tambah Ruangan
                    </a>
                </nav>
            </div>
        </div>

        <!-- Profil User di Bawah Sidebar -->
        <div class="p-4 border-t border-gray-100">
            <div class="flex items-center p-2 bg-blue-50/60 rounded-xl border border-blue-100/50">
                <div class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-xs shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <div class="ml-3 overflow-hidden">
                    <p class="text-xs font-bold text-gray-900 truncate">Admin Sarpras</p>
                    <p class="text-[10px] text-gray-500 truncate">Gedung A, B & C</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- KONTEN UTAMA DENGAN BACKGROUND GEDUNG VOKASI -->
    <main class="flex-1 flex flex-col overflow-y-auto relative bg-slate-50">
        
        <!-- Breadcrumb Header -->
        <div class="bg-white px-8 py-3 border-b border-gray-200 text-xs text-gray-500 flex items-center space-x-2 relative z-10">
            <span class="text-blue-600 font-medium">SIPLUS</span>
            <span>›</span>
            <span class="text-gray-700 font-medium">Status Permohonan</span>
        </div>

        <!-- AREA UTAMA Halaman -->
        <div class="p-8 max-w-7xl w-full mx-auto relative z-10">
            
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Status Peminjaman & Penentuan Jam Pinjam</h2>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <!-- KOLOM KIRI: DAFTAR STATUS PERMOHONAN (7 COLS) -->
                <div class="lg:col-span-7 space-y-4">
                    
                    <!-- ITEM 1: DISETUJUI -->
                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm space-y-4">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start space-x-3">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 text-sm">Ruang Kuliah GA-201 <span class="text-blue-600">•</span></h3>
                                    <p class="text-xs text-gray-500 mt-0.5">Kuliah Pengganti Aljabar Linear</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-100">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-emerald-500 rounded-full"></span> Disetujui
                            </span>
                        </div>

                        <div class="pt-2 border-t border-gray-100 flex items-center justify-between text-xs">
                            <span class="text-gray-500 font-medium">📅 Rabu, 18 Sep 2026 • <span class="text-blue-600 font-bold">Sesi Siap Dipilih</span></span>
                            <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-sm transition flex items-center space-x-1.5 text-xs">
                                <span>🕒 Pilih Jam Pinjam</span>
                            </button>
                        </div>
                    </div>

                    <!-- ITEM 2: MENUNGGU VERIFIKASI -->
                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm space-y-4">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start space-x-3">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 text-sm">Ruang GB-304 <span class="text-blue-600">•</span></h3>
                                    <p class="text-xs text-gray-500 mt-0.5">Praktikum Jaringan Komputer</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-50 text-amber-600 border border-amber-100">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-amber-500 rounded-full"></span> Menunggu Verifikasi Sarpras
                            </span>
                        </div>
                    </div>

                    <!-- ITEM 3: DITOLAK -->
                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm space-y-4">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start space-x-3">
                                <div class="w-10 h-10 rounded-xl bg-rose-50 border border-rose-100 flex items-center justify-center text-rose-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 text-sm">Ruang GA-101 <span class="text-gray-400">•</span> Bahasa Inggris Bisnis</h3>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-50 text-rose-600 border border-rose-100">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-rose-500 rounded-full"></span> Ditolak
                            </span>
                        </div>
                    </div>

                </div>

                <!-- KOLOM KANAN: FORM PENENTUAN JAM PINJAM & KONTAK SARPRAS (5 COLS) -->
                <div class="lg:col-span-5 space-y-4">
                    
                    <!-- PANEL TENTUKAN JAM PINJAM -->
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-md space-y-5">
                        <div>
                            <h3 class="font-bold text-gray-900 text-sm">Tentukan Jam Pinjam: GA-201</h3>
                            <p class="text-[11px] text-gray-500 mt-0.5">Pilih Slot Sesi Perkuliahan (Bisa pilih lebih dari 1)</p>
                        </div>

                        <form action="#" method="POST" class="space-y-3">
                            @csrf
                            
                            <!-- SESI 1 -->
                            <label class="flex items-center justify-between p-3.5 border border-gray-200 rounded-xl cursor-pointer hover:border-blue-400 transition bg-white">
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" name="sesi[]" value="1" class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                                    <span class="text-xs font-bold text-gray-800">Sesi 1: 07.00 - 09.00 WIB</span>
                                </div>
                            </label>

                            <!-- SESI 2 (SELECTED/CHECKED) -->
                            <label class="flex items-center justify-between p-3.5 border-2 border-blue-600 bg-blue-50/50 rounded-xl cursor-pointer transition">
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" name="sesi[]" value="2" checked class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                                    <span class="text-xs font-bold text-blue-900">Sesi 2: 09.00 - 11.00 WIB</span>
                                </div>
                            </label>

                            <!-- SESI 3 -->
                            <label class="flex items-center justify-between p-3.5 border border-gray-200 rounded-xl cursor-pointer hover:border-blue-400 transition bg-white">
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" name="sesi[]" value="3" class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                                    <span class="text-xs font-bold text-gray-800">Sesi 3: 11.00 - 13.00 WIB</span>
                                </div>
                            </label>

                            <!-- TOMBOL KONFIRMASI & CETAK -->
                            <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-md transition flex items-center justify-center space-x-2 mt-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                                <span>Konfirmasi & Cetak Surat Peminjaman</span>
                            </button>
                        </form>
                    </div>

                    <!-- CARD BANNER KONTAK SARPRAS -->
                    <div class="bg-blue-50/70 border border-blue-100 rounded-2xl p-4 flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold">
                                🎧
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-xs">Butuh Ruang Alternatif?</h4>
                                <p class="text-[11px] text-gray-500">Hubungi Biro Sarana & Prasarana Kampus B</p>
                            </div>
                        </div>
                        <a href="#" class="px-3.5 py-1.5 bg-white border border-blue-200 text-blue-600 hover:bg-blue-600 hover:text-white rounded-lg text-xs font-bold transition shadow-sm">
                            Kontak Sarpras
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </main>

</body>
</html>