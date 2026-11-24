<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Peminjaman - SIPLUS Vokasi UNAIR</title>
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
                <div class="text-xs text-gray-400 font-medium tracking-wide mb-1">STATUS PEMINJAMAN</div>
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
                    
                    <a href="{{ url('/admin/peminjaman') }}" class="flex items-center px-3 py-2.5 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg transition">
                        <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
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
                        {{ strtoupper(substr($user->username ?? $user->name ?? $user->nama ?? 'U', 0, 1)) }}
                    </div>
                    <div class="ml-3 min-w-0">
                        <p class="text-xs font-bold text-gray-900 truncate">{{ $user->username ?? $user->name ?? $user->nama ?? 'Pengguna' }}</p>
                        <p class="text-[10px] text-gray-500 capitalize truncate">{{ ($isPengelola ?? false) ? 'Pengelola / Admin' : 'Mahasiswa' }}</p>
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
        <!-- Breadcrumb Header -->
        <div class="bg-white px-8 py-3 border-b border-gray-200 text-xs text-gray-500 flex items-center space-x-2">
            <span class="text-blue-600 font-medium">SIPLUS</span>
            <span>›</span>
            <span class="text-gray-700 font-medium">Status Peminjaman</span>
        </div>

        <!-- Isi Halaman -->
        <div class="p-8 max-w-7xl w-full mx-auto space-y-6">
            
            <!-- Judul Halaman -->
            <div>
                <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Status Peminjaman & Penentuan Jam Pinjam</h2>
                <p class="text-xs text-gray-500 mt-1">Kelola dan pantau status permohonan peminjaman ruangan serta tentukan slot waktu perkuliahan.</p>
            </div>

            <!-- Layout Grid 2 Kolom -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- KOLOM KIRI (Daftar Ruangan & Status) -->
                <div class="lg:col-span-2 space-y-4">
                    
                    <!-- Item 1: Disetujui / Siap Pilih -->
                    <div class="bg-blue-50/40 border border-blue-200 rounded-2xl p-5 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                        <div class="flex items-start space-x-4">
                            <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <div>
                                <div class="flex items-center space-x-2">
                                    <h3 class="font-bold text-gray-900 text-sm">Ruang Kuliah GA-201</h3>
                                    <span class="w-1.5 h-1.5 bg-blue-600 rounded-full"></span>
                                    <span class="bg-emerald-100 text-emerald-700 text-[10px] font-bold px-2 py-0.5 rounded-full">Disetujui</span>
                                </div>
                                <p class="text-xs text-blue-700 font-medium mt-0.5">Kuliah Pengganti Aljabar Linear</p>
                                <div class="flex items-center space-x-3 mt-3 text-[11px] text-gray-500">
                                    <span class="flex items-center">
                                        <svg class="w-3.5 h-3.5 mr-1 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        Rabu, 18 Sep 2026
                                    </span>
                                    <span class="text-blue-600 font-medium bg-blue-100/60 px-2 py-0.5 rounded">Sesi Siap Dipilih</span>
                                </div>
                            </div>
                        </div>
                        <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-sm transition flex items-center space-x-1 shrink-0">
                            <span>Pilih Jam Pinjam</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>

                    <!-- Item 2: Menunggu Verifikasi -->
                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                        <div class="flex items-start space-x-4">
                            <div class="w-10 h-10 rounded-xl bg-gray-100 text-gray-600 flex items-center justify-center font-bold shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <div class="flex items-center space-x-2">
                                    <h3 class="font-bold text-gray-900 text-sm">Ruang GB-304</h3>
                                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full"></span>
                                    <span class="bg-amber-100 text-amber-800 text-[10px] font-bold px-2 py-0.5 rounded-full">Menunggu Verifikasi Sarpras</span>
                                </div>
                                <p class="text-xs text-gray-600 font-medium mt-0.5">Praktikum Jaringan Komputer</p>
                            </div>
                        </div>
                    </div>

                    <!-- Item 3: Ditolak -->
                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4 opacity-75">
                        <div class="flex items-start space-x-4">
                            <div class="w-10 h-10 rounded-xl bg-red-50 text-red-600 flex items-center justify-center font-bold shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                            </div>
                            <div>
                                <div class="flex items-center space-x-2">
                                    <h3 class="font-bold text-gray-900 text-sm">Ruang GA-101</h3>
                                    <span class="w-1.5 h-1.5 bg-red-400 rounded-full"></span>
                                    <span class="bg-red-100 text-red-700 text-[10px] font-bold px-2 py-0.5 rounded-full">Ditolak</span>
                                </div>
                                <p class="text-xs text-gray-600 font-medium mt-0.5">Bahasa Inggris Bisnis</p>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- KOLOM KANAN (Panel Penentuan Jam Pinjam Interaktif) -->
                <div class="space-y-4">
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm space-y-5">
                        <div>
                            <h3 class="font-bold text-gray-900 text-base leading-snug">Tentukan Jam Pinjam: GA-201</h3>
                            <p class="text-[11px] text-gray-500 mt-1">Pilih salah satu slot waktu sesi perkuliahan untuk ruangan ini.</p>
                        </div>

                        <!-- Opsi Slot Waktu -->
                        <div class="space-y-3" id="sesi-container">
                            
                            <label class="sesi-card flex items-center justify-between p-3.5 rounded-xl border border-gray-200 hover:border-blue-300 cursor-pointer transition">
                                <div class="flex items-center space-x-3">
                                    <input type="radio" name="sesi_jam" value="1" class="sesi-radio w-4 h-4 text-blue-600 focus:ring-blue-500">
                                    <span class="sesi-text text-xs font-semibold text-gray-800">Sesi 1: 07.00 - 09.00 WIB</span>
                                </div>
                            </label>

                            <label class="sesi-card flex items-center justify-between p-3.5 rounded-xl border-2 border-blue-500 bg-blue-50/40 cursor-pointer transition">
                                <div class="flex items-center space-x-3">
                                    <input type="radio" name="sesi_jam" value="2" checked class="sesi-radio w-4 h-4 text-blue-600 focus:ring-blue-500">
                                    <span class="sesi-text text-xs font-bold text-blue-900">Sesi 2: 09.00 - 11.00 WIB</span>
                                </div>
                            </label>

                            <label class="sesi-card flex items-center justify-between p-3.5 rounded-xl border border-gray-200 hover:border-blue-300 cursor-pointer transition">
                                <div class="flex items-center space-x-3">
                                    <input type="radio" name="sesi_jam" value="3" class="sesi-radio w-4 h-4 text-blue-600 focus:ring-blue-500">
                                    <span class="sesi-text text-xs font-semibold text-gray-800">Sesi 3: 11.00 - 13.00 WIB</span>
                                </div>
                            </label>

                        </div>

                        <!-- Tombol Konfirmasi -->
                        <button class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-sm transition flex items-center justify-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                            <span>Konfirmasi & Cetak Surat Peminjaman</span>
                        </button>
                    </div>

                    <!-- Bantuan / Kontak Alternatif -->
                    <div class="bg-blue-50/50 border border-blue-100 rounded-2xl p-4 flex items-center justify-between">
                        <div>
                            <h4 class="text-xs font-bold text-gray-900">Butuh Ruang Alternatif?</h4>
                            <p class="text-[10px] text-gray-500 mt-0.5">Hubungi Biro Sarana & Prasarana Kampus B</p>
                        </div>
                        <a href="#" class="px-3 py-1.5 bg-white border border-gray-200 text-blue-600 hover:bg-blue-50 rounded-lg text-xs font-bold transition shadow-sm">
                            Kontak Sarpras
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </main>

    <!-- SCRIPT JAVASCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sesiCards = document.querySelectorAll('.sesi-card');
            const sesiRadios = document.querySelectorAll('.sesi-radio');

            sesiRadios.forEach((radio) => {
                radio.addEventListener('change', function () {
                    sesiCards.forEach((card) => {
                        card.classList.remove('border-2', 'border-blue-500', 'bg-blue-50/40');
                        card.classList.add('border', 'border-gray-200');
                        
                        const textSpan = card.querySelector('.sesi-text');
                        textSpan.classList.remove('font-bold', 'text-blue-900');
                        textSpan.classList.add('font-semibold', 'text-gray-800');
                    });

                    if (this.checked) {
                        const activeCard = this.closest('.sesi-card');
                        activeCard.classList.remove('border', 'border-gray-200');
                        activeCard.classList.add('border-2', 'border-blue-500', 'bg-blue-50/40');

                        const activeText = activeCard.querySelector('.sesi-text');
                        activeText.classList.remove('font-semibold', 'text-gray-800');
                        activeText.classList.add('font-bold', 'text-blue-900');
                    }
                });
            });
        });
    </script>
</body>
</html>