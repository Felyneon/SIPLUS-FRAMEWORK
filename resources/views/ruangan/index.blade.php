<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ruangan - SIPLUS Vokasi UNAIR</title>
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

                    <a href="{{ route('peminjaman.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 transition">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        Status Peminjaman
                    </a>

                    <!-- Ruangan (Aktif / Menyala) -->
                    <a href="{{ url('/ruangan') }}" class="flex items-center justify-between px-3 py-2.5 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg transition">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            Ruangan
                        </div>
                        <span class="text-[10px] bg-blue-200 text-blue-800 px-1.5 py-0.5 rounded font-bold">Kelas</span>
                    </a>

                    <a href="{{ url('/dashboard') }}" class="flex items-center justify-between px-3 py-2.5 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 transition">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/></svg>
                            Ruang Aula
                        </div>
                        <span class="text-[9px] bg-amber-100 text-amber-700 px-1.5 py-0.5 rounded font-bold">SOON</span>
                    </a>

                    <!-- Tambah Ruangan Hanya Muncul untuk Pengelola -->
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
                        <p class="text-[10px] text-gray-500 capitalize truncate">
                            {{ $isPengelola ? 'Pengelola / Admin' : 'Mahasiswa' }}
                        </p>
                    </div>
                </div>

                <!-- Tombol Logout -->
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
            <span class="text-gray-700 font-medium">Ruangan</span>
        </div>

        <!-- Bagian Konten Utama -->
        <div class="p-8 max-w-7xl w-full mx-auto space-y-6">
            
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
    </main>
</body>
</html>
{{-- resources/views/ruangan/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Kelola Data Ruangan Fakultas Vokasi</h4>
        <a href="{{ route('ruangan.create') }}" class="btn btn-primary">+ Tambah Ruangan</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif

    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control"
                placeholder="Cari nama ruangan / lokasi..." value="{{ request('search') }}">
        </div>
        <div class="col-auto">
            <button class="btn btn-outline-secondary">Cari</button>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width:60px">No</th>
                        <th>Nama Ruangan</th>
                        <th>Kapasitas</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th style="width:160px" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ruangans as $ruangan)
                        <tr>
                            <td>{{ $ruangans->firstItem() + $loop->index }}</td>
                            <td>{{ $ruangan->nama_ruangan }}</td>
                            <td>{{ $ruangan->kapasitas }} orang</td>
                            <td>{{ $ruangan->lokasi }}</td>
                            <td>
                                @if ($ruangan->status === 'tersedia')
                                    <span class="badge bg-success">Tersedia</span>
                                @else
                                    <span class="badge bg-secondary">Tidak Tersedia</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('ruangan.edit', $ruangan) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('ruangan.destroy', $ruangan) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Hapus ruangan {{ $ruangan->nama_ruangan }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">Belum ada data ruangan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">{{ $ruangans->links() }}</div>
</div>
@endsection