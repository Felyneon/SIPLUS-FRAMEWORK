<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SIPLUS') - SIPLUS Fakultas Vokasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-800">
@php
    $menu = [
        ['label' => 'Beranda', 'url' => '/dashboard', 'match' => 'dashboard', 'icon' => 'M3 12l9-9 9 9M5 10v10h14V10'],
        ['label' => 'Status Peminjaman', 'url' => '/admin/peminjaman', 'match' => 'admin/peminjaman*', 'icon' => 'M9 5h6M9 3h6a2 2 0 012 2v14a2 2 0 01-2 2H9a2 2 0 01-2-2V5a2 2 0 012-2zM10 11h4M10 15h4'],
        ['label' => 'Ruangan', 'url' => '/ruangan', 'match' => 'ruangan', 'icon' => 'M4 4h16v16H4zM4 10h16M10 10v10'],
        ['label' => 'Tambah Ruangan', 'url' => '/ruangan/tambah', 'match' => 'ruangan/tambah', 'icon' => 'M12 8v8M8 12h8M12 21a9 9 0 100-18 9 9 0 000 18z'],
    ];
@endphp
<div class="flex min-h-screen">
    <aside class="w-60 shrink-0 bg-white border-r border-slate-200 flex flex-col">
        <div class="px-5 py-5 flex items-center gap-3 border-b border-slate-100">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-700 grid place-items-center font-bold">S</div>
            <div>
                <p class="text-lg font-bold text-blue-700 leading-tight">SIPLUS</p>
                <p class="text-[11px] text-slate-500">Fakultas Vokasi UNAIR</p>
            </div>
        </div>
        <nav class="px-3 py-4 flex-1">
            <p class="px-2 mb-2 text-[10px] font-semibold tracking-wider text-slate-400 uppercase">Menu Utama</p>
            @foreach ($menu as $m)
                @php $active = request()->is($m['match']); @endphp
                <a href="{{ $m['url'] }}"
                   class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm font-medium {{ $active ? 'bg-blue-100 text-blue-800' : 'text-slate-600 hover:bg-slate-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="{{ $m['icon'] }}"/></svg>
                    {{ $m['label'] }}
                </a>
            @endforeach
        </nav>
        <div class="p-3 border-t border-slate-100">
            <div class="flex items-center gap-3 bg-blue-50 rounded-lg px-3 py-2">
                <div class="w-8 h-8 rounded-full bg-blue-700 text-white grid place-items-center text-xs font-semibold">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold truncate">{{ auth()->user()->name ?? 'Admin Sarpras' }}</p>
                    <p class="text-[10px] text-slate-500">Gedung A, B &amp; C</p>
                </div>
            </div>
        </div>
    </aside>

    <main class="flex-1 min-w-0">
        <div class="px-8 py-4 bg-white border-b border-slate-200 text-xs text-slate-500">
            <span class="text-blue-700 font-medium">SIPLUS</span> &rsaquo;
            <span class="font-semibold text-slate-700">@yield('breadcrumb')</span>
        </div>
        <div class="p-8">
            @if (session('success'))
                <div class="mb-4 rounded-lg bg-emerald-50 text-emerald-800 text-sm px-4 py-3">{{ session('success') }}</div>
            @endif
            @yield('content')
        </div>
    </main>
</div>
</body>
</html>