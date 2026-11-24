<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SIPLUS') - SIPLUS Fakultas Vokasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { color-scheme: light; }
        html { min-height: 100%; }
        body { font-family: 'Inter', sans-serif; }
        .siplus-scrollbar::-webkit-scrollbar { width: 8px; height: 8px; }
        .siplus-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 20px; }
        [x-cloak] { display: none !important; }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">
@php
    $user = auth()->user();
    $roleId = $user?->roleId();
    $isPengelola = $roleId === \App\Models\Role::PENGELOLA || $user?->role === 'pengelola';

    $menu = [
        [
            'label' => 'Beranda',
            'route' => 'dashboard',
            'active' => ['dashboard', 'admin.dashboard'],
            'icon' => 'M3 10.5 12 3l9 7.5M5.5 9v11h13V9M9 20v-6h6v6',
        ],
    ];

    if ($isPengelola) {
        $menu = array_merge($menu, [
            ['label' => 'Status Peminjaman', 'route' => 'admin.peminjaman.index', 'active' => ['admin.peminjaman.*'], 'icon' => 'M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01'],
            ['label' => 'Ruangan', 'route' => 'ruangan.index', 'active' => ['ruangan.index', 'ruangan.edit'], 'icon' => 'M3 21h18M5 21V5l7-2 7 2v16M9 8h1m4 0h1m-6 4h1m4 0h1m-5 4h1m4 0h1'],
            ['label' => 'Tambah Ruangan', 'route' => 'ruangan.create', 'active' => ['ruangan.create'], 'icon' => 'M12 5v14M5 12h14'],
            ['label' => 'Kelola Pengguna', 'route' => 'admin.pengguna.index', 'active' => ['admin.pengguna.*'], 'icon' => 'M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2M10 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8M20 8v6m3-3h-6'],
        ]);
    } else {
        $menu = array_merge($menu, [
            ['label' => 'Ruangan', 'route' => 'ruangan.index', 'active' => ['ruangan.index'], 'icon' => 'M3 21h18M5 21V5l7-2 7 2v16M9 8h1m4 0h1m-6 4h1m4 0h1'],
            ['label' => 'Ajukan Peminjaman', 'route' => 'peminjaman.create', 'active' => ['peminjaman.create'], 'icon' => 'M12 5v14M5 12h14'],
            ['label' => 'Status Peminjaman', 'route' => 'peminjaman.index', 'active' => ['peminjaman.index'], 'icon' => 'M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01'],
        ]);
    }
@endphp

<div class="min-h-screen md:flex">
    <!-- Sidebar desktop: dipakai oleh semua halaman yang memakai layouts.app -->
    <aside class="hidden md:flex md:fixed md:inset-y-0 md:z-30 md:w-64 md:flex-col border-r border-slate-200 bg-white">
        <a href="{{ route('dashboard') }}" class="flex h-[82px] shrink-0 items-center gap-3 border-b border-slate-100 px-5">
            <span class="grid h-10 w-10 place-items-center rounded-xl bg-blue-50 text-lg font-bold text-blue-700">S</span>
            <span class="min-w-0">
                <span class="block text-lg font-bold leading-tight text-blue-700">SIPLUS</span>
                <span class="block text-[11px] text-slate-500">Fakultas Vokasi UNAIR</span>
            </span>
        </a>

        <nav class="siplus-scrollbar flex-1 overflow-y-auto px-3 py-5">
            <p class="mb-3 px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400">Menu Utama</p>
            <div class="space-y-1">
                @foreach ($menu as $item)
                    @if (Route::has($item['route']))
                        @php
                            $active = collect($item['active'])->contains(fn ($pattern) => request()->routeIs($pattern));
                        @endphp
                        <a href="{{ route($item['route']) }}"
                           @if($active) aria-current="page" @endif
                           class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition {{ $active ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-700' }}">
                            <svg class="h-5 w-5 shrink-0 {{ $active ? 'text-blue-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="{{ $item['icon'] }}"/></svg>
                            <span>{{ $item['label'] }}</span>
                        </a>
                    @endif
                @endforeach
            </div>
        </nav>

        <div class="shrink-0 border-t border-slate-100 p-3">
            <a href="{{ route('profile.edit') }}" class="mb-2 flex items-center gap-3 rounded-xl border border-blue-100 bg-blue-50/70 p-2.5 transition hover:bg-blue-50">
                <span class="grid h-9 w-9 shrink-0 place-items-center overflow-hidden rounded-full bg-blue-600 text-xs font-bold text-white">
                    @if ($user?->profile_photo_path)
                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($user->profile_photo_path) }}" alt="Foto profil" class="h-full w-full object-cover">
                    @else
                        {{ strtoupper(substr($user?->name ?? 'U', 0, 1)) }}
                    @endif
                </span>
                <span class="min-w-0 flex-1">
                    <span class="block truncate text-xs font-semibold text-slate-900">{{ $user?->name ?? 'Pengguna' }}</span>
                    <span class="block truncate text-[10px] text-slate-500">Kelola Profil</span>
                </span>
                <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 18 6-6-6-6"/></svg>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-50">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M10 17l5-5-5-5M15 12H3m9-9h6a2 2 0 012 2v14a2 2 0 01-2 2h-6"/></svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <div class="flex min-h-screen min-w-0 flex-1 flex-col md:pl-64">
        <!-- Navbar desktop -->
        <header class="sticky top-0 z-20 hidden h-[58px] shrink-0 items-center justify-between border-b border-slate-200 bg-white/95 px-8 backdrop-blur md:flex">
            <div class="flex items-center gap-2 text-xs text-slate-500">
                <span class="font-semibold text-blue-700">SIPLUS</span>
                <span aria-hidden="true">›</span>
                <span class="font-medium text-slate-700">@yield('breadcrumb', 'Beranda')</span>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-xs text-slate-500">{{ $user?->name }}</span>
                <a href="{{ route('profile.edit') }}" class="rounded-lg border border-slate-200 px-3 py-1.5 text-xs font-semibold text-slate-600 hover:bg-slate-50">Profil Saya</a>
            </div>
        </header>

        <!-- Navbar mobile -->
        <header class="sticky top-0 z-20 border-b border-slate-200 bg-white md:hidden">
            <div class="flex h-16 items-center justify-between px-4">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                    <span class="grid h-9 w-9 place-items-center rounded-lg bg-blue-50 font-bold text-blue-700">S</span>
                    <span><span class="block text-base font-bold leading-tight text-blue-700">SIPLUS</span><span class="block text-[10px] text-slate-500">Fakultas Vokasi UNAIR</span></span>
                </a>
                <details class="relative">
                    <summary class="flex cursor-pointer list-none items-center gap-2 rounded-lg border border-slate-200 px-3 py-2 text-sm font-medium text-slate-700">
                        Menu
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"/></svg>
                    </summary>
                    <nav class="absolute right-0 mt-2 w-64 rounded-xl border border-slate-200 bg-white p-2 shadow-xl">
                        @foreach ($menu as $item)
                            @if (Route::has($item['route']))
                                <a href="{{ route($item['route']) }}" class="block rounded-lg px-3 py-2.5 text-sm {{ collect($item['active'])->contains(fn ($pattern) => request()->routeIs($pattern)) ? 'bg-blue-50 font-semibold text-blue-700' : 'text-slate-600 hover:bg-slate-50' }}">{{ $item['label'] }}</a>
                            @endif
                        @endforeach
                        <a href="{{ route('profile.edit') }}" class="mt-1 block rounded-lg px-3 py-2.5 text-sm text-slate-600 hover:bg-slate-50">Kelola Profil</a>
                        <form method="POST" action="{{ route('logout') }}" class="border-t border-slate-100 pt-1">
                            @csrf
                            <button class="w-full rounded-lg px-3 py-2.5 text-left text-sm font-semibold text-red-600 hover:bg-red-50">Logout</button>
                        </form>
                    </nav>
                </details>
            </div>
            <div class="border-t border-slate-100 px-4 py-2 text-xs text-slate-500">
                SIPLUS <span class="mx-1">›</span> <span class="font-medium text-slate-700">@yield('breadcrumb', 'Beranda')</span>
            </div>
        </header>

        <main class="flex-1">
            <div class="mx-auto w-full max-w-[1500px] p-4 sm:p-6 lg:p-8">
                @if (session('success'))
                    <div role="status" class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div role="alert" class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">{{ session('error') }}</div>
                @endif
                @yield('content')
            </div>
        </main>

        <footer class="mt-auto border-t border-slate-200 bg-white px-4 py-4 sm:px-6 lg:px-8">
            <div class="mx-auto flex w-full max-w-[1500px] flex-col gap-1 text-center text-[11px] text-slate-500 sm:flex-row sm:items-center sm:justify-between sm:text-left">
                <span class="font-semibold text-slate-600">SIPLUS · Fakultas Vokasi UNAIR</span>
                <span>Sistem Informasi Peminjaman Ruangan</span>
            </div>
        </footer>
    </div>
</div>
@stack('scripts')
</body>
</html>
