<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beranda') - SIPLUS Vokasi UNAIR</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 flex h-screen overflow-hidden">
    @php
        $authUser = $user ?? auth()->user();
        $userIsPengelola = isset($isPengelola) ? (bool) $isPengelola : ((int) session('user_role') === 1);
        $displayName = $authUser->nama ?? $authUser->name ?? 'Albrtsbcn1';
        $initial = strtoupper(substr(trim($displayName), 0, 1) ?: 'A');
        $profileUrl = \Illuminate\Support\Facades\Route::has('profile.edit')
            ? route('profile.edit')
            : (\Illuminate\Support\Facades\Route::has('profil.index') ? route('profil.index') : url('/profil'));
    @endphp

    <!-- Sidebar Kiri -->
    <aside class="w-64 shrink-0 bg-white border-r border-slate-200 flex flex-col justify-between hidden md:flex">
        <div class="overflow-y-auto">
            <!-- Header Brand -->
            <div class="px-6 pt-6 pb-4">
                <div class="text-[11px] font-medium uppercase tracking-wider text-slate-400">
                    BERANDA SIPLUS
                </div>
                <div class="flex items-center gap-3 mt-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <div class="text-base font-extrabold text-slate-900 leading-tight truncate">SIPLUS</div>
                        <div class="text-xs text-slate-500 leading-tight truncate mt-0.5">Fakultas Vokasi UNAIR</div>
                    </div>
                </div>
            </div>

            <!-- Menu Utama -->
            <div class="px-4 py-2">
                <div class="px-3 mb-2 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                    MENU UTAMA
                </div>

                <nav class="space-y-1">
                    <a href="{{ url('/dashboard') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition {{ request()->is('dashboard') ? 'font-semibold text-blue-600 bg-blue-50/80' : 'font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <svg class="w-5 h-5 shrink-0 {{ request()->is('dashboard') ? 'text-blue-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span>Beranda</span>
                    </a>

                    <a href="{{ route('peminjaman.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition {{ request()->routeIs('peminjaman.index') ? 'font-semibold text-blue-600 bg-blue-50/80' : 'font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <svg class="w-5 h-5 shrink-0 {{ request()->routeIs('peminjaman.index') ? 'text-blue-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        <span>Status Peminjaman</span>
                    </a>

                    <a href="{{ route('ruangan.index') }}"
                       class="flex items-center justify-between px-3 py-2.5 rounded-xl text-sm transition {{ request()->routeIs('ruangan.index') ? 'font-semibold text-blue-600 bg-blue-50/80' : 'font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <div class="flex items-center gap-3 min-w-0">
                            <svg class="w-5 h-5 shrink-0 {{ request()->routeIs('ruangan.index') ? 'text-blue-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            <span class="truncate">Ruangan</span>
                        </div>
                        <span class="ml-2 rounded-md bg-slate-100 px-2 py-0.5 text-[11px] font-semibold text-slate-600">
                            Kelas
                        </span>
                    </a>

                    @if ($userIsPengelola)
                        <a href="{{ route('ruangan.create') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition {{ request()->routeIs('ruangan.create') ? 'font-semibold text-blue-600 bg-blue-50/80' : 'font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                            <svg class="w-5 h-5 shrink-0 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                            </svg>
                            <span>Tambah Ruangan</span>
                        </a>
                    @endif
                </nav>
            </div>
        </div>

        <!-- Footer Profil & Logout -->
        <div class="p-4 border-t border-slate-100">
            <div class="rounded-2xl bg-blue-50/50 border border-blue-100/80 p-3 space-y-3">
                <a href="{{ $profileUrl }}"
                   title="Buka Halaman Profil"
                   class="group flex items-center justify-between gap-2 rounded-xl p-1 -m-1 hover:bg-blue-100/60 transition">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-9 h-9 rounded-full bg-blue-600 text-white font-bold text-sm flex items-center justify-center shrink-0 group-hover:bg-blue-700 transition">
                            {{ $initial }}
                        </div>
                        <div class="min-w-0">
                            <div class="text-xs font-bold text-slate-900 group-hover:text-blue-700 truncate transition">{{ $displayName }}</div>
                            <div class="text-[11px] text-slate-500 truncate">
                                {{ $userIsPengelola ? 'Pengelola / Admin' : 'Mahasiswa' }}
                            </div>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600 shrink-0 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center justify-center gap-2 rounded-xl bg-white hover:bg-red-50 border border-slate-200/90 px-3 py-2 text-xs font-semibold text-slate-600 hover:text-red-600 transition cursor-pointer">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span>Keluar / Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Area Konten Utama -->
    <main class="flex-1 overflow-y-auto p-6 sm:p-8">
        @yield('content')
    </main>
</body>
</html>