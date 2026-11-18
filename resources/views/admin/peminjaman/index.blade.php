<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin: Daftar Pengajuan Peminjaman Ruangan</title>
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
                <div class="text-xs text-gray-400 font-medium tracking-wide mb-1">PILIHAN RUANGAN SIPLUS</div>
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
                    <a href="#" class="flex items-center px-3 py-2.5 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 transition">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Beranda
                    </a>
                    <a href="{{ url('/admin/peminjaman') }}" class="flex items-center px-3 py-2.5 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg transition">
                        <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        Peminjaman
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
            <span class="text-gray-700 font-medium">Panel Admin: Daftar Pengajuan Peminjaman Ruangan</span>
        </div>

        <!-- Bagian Isi Utama -->
        <div class="p-8 max-w-7xl w-full mx-auto">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Panel Admin: Daftar Pengajuan Peminjaman Ruangan</h2>
                    <p class="text-xs text-gray-500 mt-0.5">Kelola dan setujui pengajuan peminjaman ruangan dari mahasiswa.</p>
                </div>
                <div>
                    <a href="{{ url('/dashboard') }}" class="text-xs text-blue-600 hover:underline font-medium">← Kembali ke Dashboard</a>
                </div>
            </div>

            <!-- Tabel Data Peminjaman (Dinamis dari Database) -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/70 border-b border-gray-200 text-[11px] font-bold text-gray-500 uppercase tracking-wider">
                            <th class="py-3.5 px-6">No</th>
                            <th class="py-3.5 px-6">Nama Peminjam</th>
                            <th class="py-3.5 px-6">Nama Ruangan</th>
                            <th class="py-3.5 px-6">Waktu Mulai</th>
                            <th class="py-3.5 px-6">Waktu Selesai</th>
                            <th class="py-3.5 px-6">Keperluan</th>
                            <th class="py-3.5 px-6">Status</th>
                            <th class="py-3.5 px-6 text-center">Aksi / Persetujuan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-xs text-gray-700 font-medium">
                        @forelse($peminjamans as $index => $peminjaman)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="py-4 px-6 text-gray-500">{{ $index + 1 }}</td>
                            <td class="py-4 px-6 font-bold text-gray-900">{{ $peminjaman->user->name ?? '-' }}</td>
                            <td class="py-4 px-6 text-blue-600">{{ $peminjaman->ruangan->nama_ruangan ?? '-' }}</td>
                            <td class="py-4 px-6 text-gray-600">{{ $peminjaman->waktu_mulai ?? '-' }}</td>
                            <td class="py-4 px-6 text-gray-600">{{ $peminjaman->waktu_selesai ?? '-' }}</td>
                            <td class="py-4 px-6 text-gray-600">{{ $peminjaman->keperluan ?? '-' }}</td>
                            <td class="py-4 px-6">
                                @if($peminjaman->status == 'Disetujui')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">
                                        Disetujui
                                    </span>
                                @elseif($peminjaman->status == 'Ditolak')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-medium bg-rose-50 text-rose-700 border border-rose-100">
                                        Ditolak
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-medium bg-amber-50 text-amber-700 border border-amber-100">
                                        {{ $peminjaman->status ?? 'Pending' }}
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center">
                                <form action="{{ route('admin.peminjaman.update', $peminjaman->id) }}" method="POST" class="inline-flex space-x-1">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" name="status" value="Disetujui" class="px-2.5 py-1 bg-emerald-600 text-white rounded hover:bg-emerald-700 transition text-[11px]">Setujui</button>
                                    <button type="submit" name="status" value="Ditolak" class="px-2.5 py-1 bg-rose-600 text-white rounded hover:bg-rose-700 transition text-[11px]">Tolak</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="py-8 text-center text-gray-400">
                                Belum ada pengajuan peminjaman ruangan yang masuk.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </main>

</body>
</html>