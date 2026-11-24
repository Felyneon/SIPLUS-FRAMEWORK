<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Ruangan Baru - SIPLUS Vokasi UNAIR</title>
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
                <div class="text-xs text-gray-400 font-medium tracking-wide mb-1">INTERFACE PENGELOLA</div>
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
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Beranda
                    </a>
                    <a href="{{ url('/admin/peminjaman') }}" class="flex items-center px-3 py-2.5 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 transition">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        Status Permohonan
                    </a>
                    <a href="{{ url('/ruangan') }}" class="flex items-center px-3 py-2.5 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 transition">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        Ruangan
                    </a>
                    <a href="{{ url('/ruangan/create') }}" class="flex items-center px-3 py-2.5 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg transition">
                        <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
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
            <span class="text-gray-700 font-medium">Tambah Ruangan</span>
        </div>

        <!-- Bagian Isi Utama / Form -->
        <div class="p-8 max-w-5xl w-full mx-auto">

            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                    <span class="text-blue-600">➕</span> Tambah Ruangan Baru
                </h2>
                <p class="text-xs text-gray-500 mt-0.5">Masukkan data inventaris ruang kuliah atau laboratorium Kampus B (Gedung A, B, C).</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl p-4 text-xs">
                    <p class="font-bold mb-1">Periksa kembali data yang diinput:</p>
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

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
                        <!-- Lokasi / Gedung -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1.5">Lokasi / Gedung</label>
                            <div class="relative">
                                <select name="lokasi" required class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs text-gray-700 focus:outline-none focus:border-blue-500 appearance-none shadow-sm">
                                    <option value="" disabled {{ old('lokasi') ? '' : 'selected' }}>Pilih Gedung Kampus B</option>
                                    <option value="Gedung A" {{ old('lokasi') === 'Gedung A' ? 'selected' : '' }}>Gedung A</option>
                                    <option value="Gedung B" {{ old('lokasi') === 'Gedung B' ? 'selected' : '' }}>Gedung B</option>
                                    <option value="Gedung C" {{ old('lokasi') === 'Gedung C' ? 'selected' : '' }}>Gedung C</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Kode Ruangan -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1.5">Kode Ruangan</label>
                            <input type="text" name="kode_ruang" value="{{ old('kode_ruang') }}" required placeholder="Contoh: GA-101" class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:border-blue-500 shadow-sm">
                        </div>

                        <!-- Nama Ruangan -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1.5">Nama Ruangan</label>
                            <input type="text" name="nama_ruangan" value="{{ old('nama_ruangan') }}" required placeholder="Contoh: Ruang Teori Kuliah 1A" class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:border-blue-500 shadow-sm">
                        </div>

                        <!-- Kapasitas Ruangan -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1.5">Kapasitas (Jumlah Kursi)</label>
                            <input type="number" name="kapasitas" value="{{ old('kapasitas') }}" min="1" max="5000" required placeholder="Contoh: 40" class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:border-blue-500 shadow-sm">
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1.5">Deskripsi / Fasilitas</label>
                            <textarea name="deskripsi" rows="3" placeholder="Contoh: AC, Proyektor HDMI, Papan Tulis" class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:border-blue-500 shadow-sm">{{ old('deskripsi') }}</textarea>
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
                                <input type="radio" name="status" value="tersedia" {{ old('status', 'tersedia') === 'tersedia' ? 'checked' : '' }} class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500">
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
                                <input type="radio" name="status" value="pemeliharaan" {{ old('status') === 'pemeliharaan' ? 'checked' : '' }} class="h-4 w-4 text-rose-600 border-gray-300 focus:ring-rose-500">
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
    </main>

</body>
</html>