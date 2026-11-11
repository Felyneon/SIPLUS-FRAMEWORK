<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Pinjam Ruangan - SIPLUS</title>
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
                <div class="text-xs text-gray-400 font-medium tracking-wide mb-1">PENGAJUAN PINJAM SIPLUS</div>
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
                    <a href="{{ url('/peminjaman') }}" class="flex items-center px-3 py-2.5 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 transition">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
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

    <!-- KONTEN UTAMA -->
    <main class="flex-1 flex flex-col overflow-y-auto bg-slate-50">
        <!-- Breadcrumb Header -->
        <div class="bg-white px-8 py-3 border-b border-gray-200 text-xs text-gray-500 flex items-center space-x-2">
            <span class="text-blue-600 font-medium">SIPLUS</span>
            <span>›</span>
            <span class="text-gray-700 font-medium">Beranda</span>
        </div>

        <!-- BAGIAN UTAMA FORM -->
        <div class="p-8 max-w-7xl w-full mx-auto">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Pengajuan Pinjam Ruangan</h2>
                    <p class="text-xs text-gray-500 mt-0.5">Isi formulir pengajuan kuliah pengganti (PHL) untuk verifikasi ketersediaan ruangan Sarpras Gedung A, B, & C.</p>
                </div>
                <div class="bg-blue-50 border border-blue-100 px-4 py-2 rounded-xl flex items-center space-x-2 text-xs font-bold text-blue-700 shadow-sm">
                    <span class="w-5 h-5 rounded-full bg-blue-600 text-white flex items-center justify-center text-[10px]">1</span>
                    <span>Pengajuan & Verifikasi</span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <!-- KOLOM KIRI: FORM UTAMA (8 COLS) -->
                <div class="lg:col-span-8 space-y-6">
                    <form action="{{ url('/peminjaman') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- CARD 1: INFORMASI AKADEMIK & MATA KULIAH -->
                        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm space-y-4">
                            <div class="flex items-center space-x-2 pb-3 border-b border-gray-100">
                                <span class="text-blue-600 font-bold">📖</span>
                                <h3 class="font-bold text-gray-900 text-sm">1. Informasi Akademik & Mata Kuliah</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Nama Mata Kuliah</label>
                                    <input type="text" name="nama_matkul" placeholder="Contoh: Pemrograman Web" class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:border-blue-500 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Dosen Pengampu</label>
                                    <input type="text" name="dosen_pengampu" placeholder="Contoh: Nama Dosen, S.Kom., M.T." class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:border-blue-500 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Nama PJMK / Pemohon & NIM</label>
                                    <input type="text" name="nama_pjmk" placeholder="Contoh: Setiyana (04221007)" class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:border-blue-500 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Program Studi</label>
                                    <select name="prodi" class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs text-gray-700 focus:outline-none focus:border-blue-500 shadow-sm">
                                        <option value="" disabled selected>Pilih Program Studi...</option>
                                        <option value="D4 Teknik Informatika">D4 Teknik Informatika</option>
                                        <option value="D3 Sistem Informasi">D3 Sistem Informasi</option>
                                        <option value="D3 Otomasi Sistem Instrumentasi">D3 Otomasi Sistem Instrumentasi</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- CARD 2: KEBUTUHAN RUANG & WAKTU -->
                        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm space-y-4">
                            <div class="flex items-center space-x-2 pb-3 border-b border-gray-100">
                                <span class="text-blue-600 font-bold">🏛️</span>
                                <h3 class="font-bold text-gray-900 text-sm">2. Kebutuhan Ruang & Waktu Kuliah Pengganti (PHL)</h3>
                            </div>

                            <div class="space-y-4">
                                <!-- Pilih Gedung -->
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1.5">Pilih Gedung Lokasi</label>
                                    <div class="grid grid-cols-3 gap-3">
                                        <label class="border-2 border-blue-600 bg-blue-50/50 rounded-xl p-3 text-center cursor-pointer font-bold text-xs text-blue-900 shadow-sm">
                                            <input type="radio" name="gedung" value="Gedung A" checked class="hidden"> Gedung A
                                        </label>
                                        <label class="border border-gray-200 bg-white rounded-xl p-3 text-center cursor-pointer font-medium text-xs text-gray-700 hover:border-blue-400 shadow-sm">
                                            <input type="radio" name="gedung" value="Gedung B" class="hidden"> Gedung B
                                        </label>
                                        <label class="border border-gray-200 bg-white rounded-xl p-3 text-center cursor-pointer font-medium text-xs text-gray-700 hover:border-blue-400 shadow-sm">
                                            <input type="radio" name="gedung" value="Gedung C" class="hidden"> Gedung C
                                        </label>
                                    </div>
                                </div>

                                <!-- Pilih Ruangan Tersedia -->
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Pilihan Ruangan Tersedia</label>
                                    <select name="ruangan_id" class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs text-gray-700 focus:outline-none focus:border-blue-500 shadow-sm">
                                        <option value="GA-201">GA-201 - Ruang Teori Kuliah (Gedung A)</option>
                                        <option value="GA-204">GA-204 - Ruang Seminar Manajemen (Gedung A)</option>
                                    </select>
                                </div>

                                <!-- Tanggal Pelaksanaan -->
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Tanggal Pelaksanaan PHL (MM/DD/YYYY)</label>
                                    <input type="date" name="tanggal" value="2026-09-18" class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs text-gray-700 focus:outline-none focus:border-blue-500 shadow-sm">
                                </div>

                                <!-- Alasan -->
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Alasan / Keterangan Kuliah Pengganti</label>
                                    <textarea name="alasan" rows="3" placeholder="Misal: Kuliah pengganti pertemuan ke-7 yang tertunda karena agenda seminar nasional dosen..." class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:border-blue-500 shadow-sm"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- ALUR PROSES INFO BOX -->
                        <div class="bg-blue-50/80 border border-blue-100 rounded-2xl p-4 text-xs space-y-1">
                            <p class="font-bold text-blue-900 flex items-center space-x-1.5">
                                <span>ℹ️</span>
                                <span>Alur Proses Pengajuan Kuliah Pengganti:</span>
                            </p>
                            <p class="text-gray-600 leading-relaxed">
                                Setelah formulir diajukan, staf Sarpras akan memverifikasi permohonan Anda (Status: <span class="text-amber-600 font-bold">Menunggu</span> → <span class="text-emerald-600 font-bold">Disetujui/Ditolak</span>). Jika disetujui (Approved), Anda dapat langsung menentukan blok sesi jam pinjam di halaman Status Permohonan.
                            </p>
                        </div>

                        <!-- TOMBOL AKSI -->
                        <div class="flex items-center justify-end space-x-3 pt-2">
                            <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 border border-gray-200 rounded-xl text-xs font-bold text-gray-600 bg-white hover:bg-gray-50 transition shadow-sm">
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-2.5 bg-blue-700 hover:bg-blue-800 text-white rounded-xl text-xs font-bold shadow-md transition flex items-center space-x-2">
                                <span>Ajukan Permohonan Pinjam ➔</span>
                            </button>
                        </div>

                    </form>
                </div>

                <!-- KOLOM KANAN: WIDGET INFORMASI (4 COLS) -->
                <div class="lg:col-span-4 space-y-4">
                    
                    <!-- KARTU PREVIEW RUANGAN -->
                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm space-y-3">
                        <div class="w-full h-28 bg-blue-50 border border-blue-100 rounded-xl flex items-center justify-center text-blue-300 font-bold text-lg">
                            [ Preview Denah / Ruang ]
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-gray-900 text-sm">GA-201</span>
                            <span class="bg-gray-100 text-gray-600 text-[10px] font-bold px-2 py-0.5 rounded">Gedung A</span>
                        </div>
                    </div>

                    <!-- KETENTUAN SARPRAS -->
                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm space-y-3">
                        <h4 class="font-bold text-gray-900 text-xs flex items-center space-x-1.5">
                            <span>🛡️</span>
                            <span>Ketentuan PHL Sarpras</span>
                        </h4>
                        <ul class="text-[11px] text-gray-600 space-y-2 list-disc pl-4 leading-relaxed">
                            <li>Pengajuan minimal 1 hari sebelum jadwal perkuliahan pengganti dilaksanakan.</li>
                            <li>Konfirmasi pembatalan wajib dilakukan maksimal 3 jam sebelum jam pemakaian dimulai.</li>
                            <li>Pastikan mematikan AC, lampu, dan LCD proyektor setelah selesai menggunakan ruangan.</li>
                        </ul>
                    </div>

                    <!-- BANTUAN KENDALA -->
                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm flex items-start space-x-3">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 border border-blue-100 text-blue-600 flex items-center justify-center font-bold flex-shrink-0">
                            🎧
                        </div>
                        <div class="text-[11px]">
                            <h5 class="font-bold text-gray-900">Ada Kendala Jadwal?</h5>
                            <p class="text-gray-500 mt-0.5">Hubungi Ruang Sarpras Gd. B Lt. 1 (Ext: 214)</p>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </main>

</body>
</html>