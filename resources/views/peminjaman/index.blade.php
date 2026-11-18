<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat & Status Peminjaman - SIPLUS Vokasi UNAIR</title>
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

            <!-- Menu Navigasi -->
            <div class="px-4 py-2">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider px-3 mb-2">MENU UTAMA</p>
                <nav class="space-y-1">
                    <a href="{{ url('/dashboard') }}" class="flex items-center px-3 py-2.5 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 transition">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Beranda
                    </a>

                    <!-- Status Peminjaman (Aktif / Menyala) -->
                    <a href="{{ route('peminjaman.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg transition">
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
        <!-- Breadcrumb Header -->
        <div class="bg-white px-8 py-3 border-b border-gray-200 text-xs text-gray-500 flex items-center space-x-2">
            <span class="text-blue-600 font-medium">SIPLUS</span>
            <span>›</span>
            <span class="text-gray-700 font-medium">Riwayat Peminjaman</span>
        </div>

        <!-- Bagian Konten Utama (Lebar container dinaikkan ke max-w-6xl agar lebih proporsional) -->
        <div class="p-8 max-w-6xl w-full mx-auto space-y-6">
            
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Riwayat & Status Peminjaman</h2>
                    <p class="text-xs text-gray-500 mt-1">Daftar pengajuan ruangan yang pernah kamu buat.</p>
                </div>
            </div>

            <!-- List Card Riwayat Peminjaman dari Database -->
            <div class="space-y-4">
                @forelse($peminjamans as $item)
                    @php
                        $statusText = $item->status; 
                        $isDisetujui = in_array(strtolower($statusText), ['disetujui', 'approved']);
                        $isDitolak = in_array(strtolower($statusText), ['ditolak', 'rejected']);
                    @endphp

                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm space-y-3 transition hover:border-blue-300">
                        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                </div>
                                <div>
                                    <div class="flex items-center space-x-2">
                                        <h3 class="font-bold text-gray-900 text-sm">{{ $item->ruangan->nama_ruang ?? $item->ruangan->kode_ruang ?? 'Ruangan' }}</h3>
                                        <span class="w-1.5 h-1.5 bg-gray-300 rounded-full"></span>
                                        
                                        @if($isDisetujui)
                                            <span class="bg-emerald-100 text-emerald-700 text-[10px] font-bold px-2.5 py-0.5 rounded-full">Disetujui</span>
                                        @elseif($isDitolak)
                                            <span class="bg-red-100 text-red-700 text-[10px] font-bold px-2.5 py-0.5 rounded-full">Ditolak</span>
                                        @else
                                            <span class="bg-amber-100 text-amber-800 text-[10px] font-bold px-2.5 py-0.5 rounded-full">Menunggu Verifikasi</span>
                                        @endif
                                    </div>
                                    <p class="text-xs text-gray-600 font-medium mt-0.5">{{ $item->keperluan ?? 'Kegiatan Akademik' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Card: Tanggal & Aksi Tombol -->
                        <div class="border-t border-gray-100 pt-3 flex flex-col md:flex-row items-start md:items-center justify-between gap-3 text-xs text-gray-500">
                            <div class="flex items-center space-x-3">
                                <span class="flex items-center font-medium text-gray-700">
                                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y') }}
                                </span>
                            </div>

                            @if($isDisetujui)
                                <a href="{{ route('peminjaman.detail', $item->id ?? '') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-sm transition flex items-center space-x-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    <span>Pilih Jam Pinjam & Cetak Surat</span>
                                </a>
                            @else
                                <span class="text-[11px] text-gray-400 italic">Menunggu persetujuan untuk memilih jam</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <!-- Tampilan Kosong Diperbesar (Lebar, Padding, Ukuran Ikon, dan Font Dinaikkan) -->
                    <div class="bg-white border border-gray-200 rounded-3xl py-32 px-12 text-center space-y-8 shadow-sm flex flex-col items-center justify-center">
                        <!-- Ikon Diperbesar -->
                        <div class="w-36 h-36 bg-blue-50 text-blue-600 rounded-[2.5rem] flex items-center justify-center shadow-sm">
                            <svg class="w-20 h-20" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        </div>
                        <!-- Font dan Teks Dinaikkan Ukurannya -->
                        <div class="space-y-3 max-w-lg mx-auto">
                            <h4 class="text-2xl font-extrabold text-gray-900 tracking-tight">Belum ada riwayat peminjaman</h4>
                            <p class="text-base text-gray-500 leading-relaxed">Kamu belum pernah mengajukan peminjaman ruangan. Silakan lakukan peminjaman ruangan melalui menu Beranda.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $peminjamans->links() }}
            </div>

        </div>
    </main>
</body>
</html>