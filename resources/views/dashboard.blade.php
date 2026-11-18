<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - SIPLUS Vokasi UNAIR</title>
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
                <div class="text-xs text-gray-400 font-medium tracking-wide mb-1">BERANDA SIPLUS</div>
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
                    <a href="{{ url('/dashboard') }}" class="flex items-center px-3 py-2.5 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg transition">
                        <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Beranda
                    </a>
                    <a href="{{ url('/admin/peminjaman') }}" class="flex items-center px-3 py-2.5 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 transition">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        Status Peminjaman
                    </a>
                    <a href="{{ url('/ruangan') }}" class="flex items-center justify-between px-3 py-2.5 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 transition">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            Ruangan
                        </div>
                        <span class="text-[10px] bg-gray-200 text-gray-700 px-1.5 py-0.5 rounded font-bold">Kelas</span>
                    </a>
                    <a href="#" class="flex items-center justify-between px-3 py-2.5 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 transition">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/></svg>
                            Ruang Aula
                        </div>
                        <span class="text-[9px] bg-amber-100 text-amber-700 px-1.5 py-0.5 rounded font-bold">BARU</span>
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

    <!-- KONTEN UTAMA -->
    <main class="flex-1 flex flex-col overflow-y-auto">
        <!-- Breadcrumb Header -->
        <div class="bg-white px-8 py-3 border-b border-gray-200 text-xs text-gray-500 flex items-center space-x-2">
            <span class="text-blue-600 font-medium">SIPLUS</span>
            <span>›</span>
            <span class="text-gray-700 font-medium">Beranda</span>
        </div>

        <!-- Bagian Isi Utama -->
        <div class="p-8 max-w-7xl w-full mx-auto space-y-6">
            
            <!-- BANNER UTAMA -->
            <div class="relative bg-gradient-to-r from-blue-950 via-blue-900 to-indigo-900 rounded-2xl p-8 text-white shadow-md overflow-hidden">
                <div class="relative z-10 max-w-3xl">
                    <div class="text-[11px] text-blue-300 font-medium tracking-wide mb-1">SIPLUS › Beranda</div>
                    <h2 class="text-3xl font-extrabold tracking-tight mb-2">Selamat Datang di SIPLUS</h2>
                    <p class="text-xs text-blue-100 leading-relaxed opacity-90">
                        Sistem Peminjaman Ruang Kuliah & Aula Fakultas Vokasi UNAIR Gedung A, B, & C. Kelola jadwal perkuliahan, seminar auditorium, dan kegiatan akademik secara terintegrasi.
                    </p>
                </div>
            </div>

            <!-- SEARCH & FILTER -->
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="relative w-full md:w-96">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </span>
                    <input type="text" placeholder="Cari ruang kelas, auditorium, kapasitas atau lantai..." class="w-full pl-9 pr-4 py-2 bg-white border border-gray-200 rounded-lg text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:border-blue-500 shadow-sm">
                </div>
                <div class="flex items-center space-x-2 w-full md:w-auto overflow-x-auto pb-1 md:pb-0">
                    <button class="px-4 py-1.5 bg-blue-600 text-white rounded-lg text-xs font-bold shadow-sm">Semua</button>
                    <button class="px-4 py-1.5 bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 rounded-lg text-xs font-medium">Gedung A</button>
                    <button class="px-4 py-1.5 bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 rounded-lg text-xs font-medium">Gedung B</button>
                    <button class="px-4 py-1.5 bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 rounded-lg text-xs font-medium">Gedung C</button>
                </div>
            </div>

            <!-- SECTION: RUANG AULA UTAMA VOKASI -->
            <div>
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-2">
                        <h3 class="font-bold text-gray-900 text-sm">Ruang Aula Utama Vokasi (Gedung A, B & C)</h3>
                        <span class="bg-blue-100 text-blue-700 text-[10px] font-bold px-2 py-0.5 rounded-full">Pilihan Utama</span>
                    </div>
                    <a href="#" class="text-xs font-bold text-blue-600 hover:underline">Lihat Semua Aula ›</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Aula 1 -->
                    <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm hover:border-blue-300 transition flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="bg-blue-50 text-blue-700 text-[10px] font-bold px-2 py-0.5 rounded border border-blue-100">GEDUNG A</span>
                                <span class="text-[11px] font-bold text-emerald-600 flex items-center"><span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5"></span> Tersedia</span>
                            </div>
                            <h4 class="font-bold text-gray-900 text-sm mb-1">Aula Utama Vokasi Lt. 3</h4>
                            <p class="text-[11px] text-gray-500 leading-relaxed mb-4">Kapasitas 250 Kursi • Dual Projector • Sound System 5000W • Full Acoustic Wall</p>
                        </div>
                        <a href="{{ url('/ruangan') }}" class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-bold text-center transition flex items-center justify-center space-x-1">
                            <span>Pinjam Ruang Aula</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>

                    <!-- Aula 2 -->
                    <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm hover:border-blue-300 transition flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="bg-blue-50 text-blue-700 text-[10px] font-bold px-2 py-0.5 rounded border border-blue-100">GEDUNG B</span>
                                <span class="text-[11px] font-bold text-emerald-600 flex items-center"><span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5"></span> Tersedia</span>
                            </div>
                            <h4 class="font-bold text-gray-900 text-sm mb-1">Auditorium Serbaguna Garuda</h4>
                            <p class="text-[11px] text-gray-500 leading-relaxed mb-4">Kapasitas 180 Kursi • LED Videotron 4x2m • Stage & Podium • Live Streaming Ready</p>
                        </div>
                        <a href="{{ url('/ruangan') }}" class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-bold text-center transition flex items-center justify-center space-x-1">
                            <span>Pinjam Ruang Aula</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>

                    <!-- Aula 3 -->
                    <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm hover:border-blue-300 transition flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="bg-blue-50 text-blue-700 text-[10px] font-bold px-2 py-0.5 rounded border border-blue-100">GEDUNG C</span>
                                <span class="text-[11px] font-bold text-emerald-600 flex items-center"><span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5"></span> Tersedia</span>
                            </div>
                            <h4 class="font-bold text-gray-900 text-sm mb-1">Hall & Mini Amphitheater</h4>
                            <p class="text-[11px] text-gray-500 leading-relaxed mb-4">Kapasitas 120 Kursi • Tiered Seating • Smart Interactive Board • Surround Audio</p>
                        </div>
                        <a href="{{ url('/ruangan') }}" class="w-full py-2 bg-blue-600 hover:bg-blue