<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Peminjaman - SIPLUS Vokasi UNAIR</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
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

            <!-- Menu Navigasi (Konsisten & Beranda Menyala) -->
            <div class="px-4 py-2">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider px-3 mb-2">MENU UTAMA</p>
                <nav class="space-y-1">
                    <a href="{{ url('/dashboard') }}" class="flex items-center px-3 py-2.5 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 transition">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Beranda
                    </a>
                    
                    <a href="{{ route('peminjaman.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 transition">
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

                    <a href="{{ url('/dashboard') }}" class="flex items-center justify-between px-3 py-2.5 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 transition">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/></svg>
                            Ruang Aula
                        </div>
                        <span class="text-[9px] bg-amber-100 text-amber-700 px-1.5 py-0.5 rounded font-bold">SOON</span>
                    </a>

                    @if(isset($isPengelola) && $isPengelola)
                        <a href="{{ url('/ruangan/create') }}" class="flex items-center px-3 py-2.5 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 transition">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                            Tambah Ruangan
                        </a>
                    @endif
                </nav>
            </div>
        </div>

        <!-- Profil User & Logout -->
        <div class="p-3 border-t border-gray-100 bg-white">
            <div class="bg-blue-50/60 rounded-xl p-3 border border-blue-100/50 flex flex-col gap-3">
                <div class="flex items-center min-w-0">
                    <div class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-xs shadow-sm shrink-0">
                        {{ strtoupper(substr($user->nama ?? $user->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="ml-3 min-w-0">
                        <p class="text-xs font-bold text-gray-900 truncate">{{ $user->nama ?? $user->name ?? 'Guest' }}</p>
                        <p class="text-[10px] text-gray-500 capitalize truncate">{{ $isPengelola ? 'Pengelola / Admin' : 'Mahasiswa' }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="m-0 w-full">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-1.5 py-1.5 px-3 bg-white hover:bg-red-50 text-gray-600 hover:text-red-600 text-xs font-medium rounded-lg border border-gray-200 transition-colors shadow-sm cursor-pointer">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Keluar / Logout
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- KONTEN UTAMA -->
    <main class="flex-1 flex flex-col overflow-y-auto">
        <div class="bg-white px-8 py-3 border-b border-gray-200 text-xs text-gray-500 flex items-center space-x-2">
            <span class="text-blue-600 font-medium">SIPLUS</span>
            <span>›</span>
            <span class="text-gray-700 font-medium">Pengajuan Pinjam Ruangan</span>
        </div>

        <div class="p-8 max-w-7xl w-full mx-auto space-y-6">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Pengajuan Pinjam Ruangan</h2>
                    <p class="text-xs text-gray-500 mt-1">Isi formulir pengajuan kuliah pengganti (PHL) untuk verifikasi ketersediaan ruangan Sarpras.</p>
                </div>
                <div class="bg-blue-100 text-blue-800 text-xs font-bold px-4 py-2.5 rounded-xl flex items-center space-x-2 shadow-sm w-fit">
                    <span class="w-5 h-5 bg-blue-600 text-white rounded-full flex items-center justify-center text-[11px]">1</span>
                    <span>Pengajuan & Verifikasi</span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- KOLOM KIRI (Formulir Pengajuan) -->
                <div class="lg:col-span-2">
                    <form action="{{ route('peminjaman.store') }}" method="POST" class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm space-y-6">
                        @csrf

                        <!-- Section 1: Informasi Akademik -->
                        <div class="space-y-4">
                            <div class="flex items-center space-x-2 text-xs font-bold text-gray-800 border-b border-gray-100 pb-2">
                                <span class="w-6 h-6 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center">1</span>
                                <span>Informasi Akademik & Mata Kuliah</span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Nama Mata Kuliah</label>
                                    <input type="text" name="nama_mata_kuliah" placeholder="Misal: Aljabar Linear" required class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:outline-none focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Dosen Pengampu</label>
                                    <input type="text" name="dosen_pengampu" placeholder="Nama dosen beserta gelar" required class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:outline-none focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Nama PJMK / Pemohon & NIM</label>
                                    <input type="text" name="nama_pjmk" value="{{ $user->nama ?? $user->name ?? '' }} - {{ $user->nim ?? '434251030' }}" required class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:outline-none focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Program Studi</label>
                                    <select name="program_studi" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:outline-none focus:border-blue-500">
                                        <option value="D4 Teknologi Informasi (TI-B1)">D4 Teknologi Informasi (TI-B1)</option>
                                        <option value="D3 Sistem Informasi">D3 Sistem Informasi</option>
                                        <option value="D3 Teknik Otomasi">D3 Teknik Otomasi</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Kebutuhan Ruang & Waktu -->
                        <div class="space-y-4 pt-2">
                            <div class="flex items-center space-x-2 text-xs font-bold text-gray-800 border-b border-gray-100 pb-2">
                                <span class="w-6 h-6 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center">2</span>
                                <span>Kebutuhan Ruang & Waktu Kuliah Pengganti (PHL)</span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Pilihan Ruangan (Terkunci)</label>
                                    <!-- Input hidden agar ID ruangan tetap terkirim ke database -->
                                    <input type="hidden" name="ruangan_id" value="{{ $ruanganDipilih->id ?? '' }}">
                                    
                                    <div class="w-full px-3 py-2.5 bg-gray-100 border border-gray-200 rounded-xl text-xs font-bold text-gray-800 flex items-center justify-between">
                                        <span>{{ $ruanganDipilih->kode_ruang ?? '-' }} - {{ $ruanganDipilih->nama_ruang ?? 'Ruang Kuliah' }}</span>
                                        <span class="text-[10px] bg-blue-100 text-blue-700 px-2 py-0.5 rounded font-bold">Terkunci</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Tanggal Pelaksanaan PHL</label>
                                    <input type="date" name="tanggal" required class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:outline-none focus:border-blue-500">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">Alasan / Keterangan Kuliah Pengganti</label>
                                <textarea name="alasan" rows="3" placeholder="Misal: Kuliah pengganti pertemuan ke-7 yang tertunda karena agenda seminar nasional dosen..." class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:outline-none focus:border-blue-500"></textarea>
                            </div>
                        </div>

                        <!-- Kotak Informasi Alur Proses -->
                        <div class="bg-blue-50/70 border border-blue-100 rounded-2xl p-4 text-xs text-blue-900 space-y-1">
                            <p class="font-bold flex items-center">
                                <svg class="w-4 h-4 mr-1 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Alur Proses Pengajuan Kuliah Pengganti:
                            </p>
                            <p class="text-gray-600 leading-relaxed pl-5">
                                Setelah formulir diajukan, staf Sarpras akan memverifikasi permohonan Anda (Status: <span class="text-amber-600 font-bold">Menunggu</span> → <span class="text-emerald-600 font-bold">Disetujui</span>/<span class="text-red-600 font-bold">Ditolak</span>). Jika disetujui, Anda dapat langsung menentukan blok sesi jam pinjam di halaman Status Permohonan.
                            </p>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex items-center justify-end space-x-3 pt-2">
                            <a href="{{ route('peminjaman.index') }}" class="px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-xs font-bold rounded-xl transition shadow-sm">
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-sm transition flex items-center space-x-1.5 cursor-pointer">
                                <span>Ajukan Permohonan Pinjam</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- KOLOM KANAN -->
                <div class="space-y-4">
                    <div class="bg-white border border-gray-200 rounded-2xl p-4 shadow-sm space-y-3">
                        <div class="w-full h-32 bg-gradient-to-br from-blue-900 to-indigo-900 rounded-xl relative overflow-hidden flex items-center justify-center text-blue-200 font-medium text-xs">
                            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:16px_16px]"></div>
                            <span>Preview Denah / Ruangan</span>
                        </div>
                        <div class="flex items-center justify-between pt-1">
                            <h4 class="font-bold text-gray-900 text-sm">{{ $ruanganDipilih->kode_ruang ?? '-' }}</h4>
                            <span class="bg-blue-50 text-blue-700 text-[10px] font-bold px-2 py-0.5 rounded border border-blue-100">Gedung {{ $ruanganDipilih->gedung ?? 'A' }}</span>
                        </div>
                        <p class="text-[11px] text-gray-500">{{ $ruanganDipilih->nama_ruang ?? 'Ruang Kuliah' }}</p>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm space-y-3">
                        <h4 class="font-bold text-gray-900 text-xs flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            Ketentuan PHL Sarpras
                        </h4>
                        <ul class="text-[11px] text-gray-600 space-y-2 leading-relaxed list-disc pl-4">
                            <li>Pengajuan minimal 1 hari sebelum jadwal perkuliahan pengganti dilaksanakan.</li>
                            <li>Konfirmasi pembatalan wajib dilakukan maksimal 3 jam sebelum jam pemakaian dimulai.</li>
                            <li>Pastikan mematikan AC, lampu, dan LCD proyektor setelah selesai menggunakan ruangan.</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </main>
</body>
</html>