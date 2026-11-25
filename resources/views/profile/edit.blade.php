@extends('layouts.app')

@section('title', 'Profil Saya')
@section('breadcrumb', 'Profil Saya')

@section('content')
@php
    $profilUser = $user ?? auth()->user();
    $namaLengkap = $profilUser->nama ?? $profilUser->name ?? 'Pengguna';
    $inisial = strtoupper(substr(trim($namaLengkap), 0, 1) ?: 'U');
    $nimNip = $profilUser->nim ?? $profilUser->nip ?? '';
    $peranLabel = !empty($isPengelola) ? 'Pengelola / Admin' : ((int) ($profilUser->role ?? 0) === 1 ? 'Pengelola / Admin' : 'Mahasiswa');

    $daftarRiwayat = collect($riwayatPeminjaman ?? $peminjamans ?? []);
    if ($daftarRiwayat->isEmpty() && $profilUser) {
        $daftarRiwayat = \App\Models\Peminjaman::with('ruangan')
            ->where('user_id', $profilUser->id)
            ->latest()
            ->get();
    }

    $totalPengajuan = $daftarRiwayat->count();
    $jumlahMenunggu = $daftarRiwayat->filter(function ($item) {
        $s = strtolower(trim((string) ($item->status ?? '')));
        return in_array($s, ['pending', 'menunggu', 'menunggu verifikasi', ''], true);
    })->count();
    $jumlahDisetujui = $daftarRiwayat->filter(function ($item) {
        $s = strtolower(trim((string) ($item->status ?? '')));
        return in_array($s, ['disetujui', 'approved', 'selesai', 'completed'], true);
    })->count();
    $jumlahDitolak = $daftarRiwayat->filter(function ($item) {
        $s = strtolower(trim((string) ($item->status ?? '')));
        return in_array($s, ['ditolak', 'rejected'], true);
    })->count();

    $riwayatRows = $daftarRiwayat->map(function ($item) {
        $rawStatus = strtolower(trim((string) ($item->status ?? '')));
        $isSelesai = in_array($rawStatus, ['selesai', 'completed', 'done'], true);
        $isDisetujui = in_array($rawStatus, ['disetujui', 'approved'], true);
        $isDitolak = in_array($rawStatus, ['ditolak', 'rejected'], true);

        if ($isSelesai) {
            $labelStatus = 'Selesai';
            $badgeClass = 'bg-blue-50 text-blue-700 border border-blue-200/70';
        } elseif ($isDisetujui) {
            $labelStatus = 'Disetujui';
            $badgeClass = 'bg-emerald-50 text-emerald-700 border border-emerald-200/70';
        } elseif ($isDitolak) {
            $labelStatus = 'Ditolak';
            $badgeClass = 'bg-red-50 text-red-700 border border-red-200/70';
        } else {
            $labelStatus = 'Menunggu';
            $badgeClass = 'bg-amber-50 text-amber-700 border border-amber-200/70';
        }

        $tglRaw = $item->tanggal ?? $item->tanggal_mulai ?? null;
        $tglFormatted = '-';
        if ($tglRaw) {
            try {
                $tglFormatted = \Carbon\Carbon::parse($tglRaw)->translatedFormat('d M Y');
            } catch (\Throwable $e) {
                $tglFormatted = (string) $tglRaw;
            }
        }

        return [
            'nama_ruang' => $item->ruangan->nama_ruangan ?? $item->ruangan->nama_ruang ?? $item->ruangan->kode_ruang ?? 'Ruangan',
            'kode_ruang' => $item->ruangan->kode_ruang ?? '',
            'matkul'     => $item->nama_mata_kuliah ?? $item->nama_matkul ?? '-',
            'keperluan'  => $item->alasan ?? $item->keperluan ?? '',
            'tanggal'    => $tglFormatted,
            'status'     => $labelStatus,
            'badge'      => $badgeClass,
        ];
    });

    $kelolaProfilUrl = \Illuminate\Support\Facades\Route::has('profile.kelola')
        ? route('profile.kelola')
        : url('/profile/kelola');
@endphp

<div class="space-y-6">
    @if (session('success') || session('status') === 'profile-updated')
        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-3.5 text-sm font-medium text-emerald-800">
            {{ session('success') ?? 'Profil berhasil diperbarui.' }}
        </div>
    @endif

    <!-- Banner Header -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-slate-950 via-blue-950 to-slate-900 px-6 py-7 sm:px-8 text-white shadow-sm">
        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-4">
                @if (!empty($profilUser->foto_profil))
                    <img src="{{ asset('storage/' . $profilUser->foto_profil) }}"
                         alt="{{ $namaLengkap }}"
                         class="w-14 h-14 rounded-2xl object-cover border border-white/20 shadow-md shrink-0">
                @elseif (!empty($profilUser->profile_photo_path))
                    <img src="{{ asset('storage/' . $profilUser->profile_photo_path) }}"
                         alt="{{ $namaLengkap }}"
                         class="w-14 h-14 rounded-2xl object-cover border border-white/20 shadow-md shrink-0">
                @else
                    <div class="w-14 h-14 rounded-2xl bg-blue-600 text-white font-extrabold text-xl flex items-center justify-center shadow-md shrink-0">
                        {{ $inisial }}
                    </div>
                @endif
                <div>
                    <div class="text-xs font-medium text-blue-200/80 mb-1">
                        SIPLUS <span class="mx-1.5">&rsaquo;</span> <span class="text-white font-semibold">Profil Saya</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">{{ $namaLengkap }}</h1>
                    <p class="text-xs sm:text-sm text-slate-200/90 mt-0.5">
                        Ringkasan aktivitas peminjaman ruangan Anda &bull; {{ $peranLabel }}
                    </p>
                </div>
            </div>

            <a href="{{ $kelolaProfilUrl }}"
               class="shrink-0 inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 hover:bg-blue-500 px-4 py-2 text-xs font-semibold text-white shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                <span>Kelola Profil</span>
            </a>
        </div>
    </div>

    <!-- 4 Kartu Ringkasan Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
            <p class="text-sm text-slate-500 font-medium">Total</p>
            <p class="text-3xl font-bold text-slate-900 mt-2">{{ $totalPengajuan }}</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
            <p class="text-sm text-slate-500 font-medium">Menunggu</p>
            <p class="text-3xl font-bold text-slate-900 mt-2">{{ $jumlahMenunggu }}</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
            <p class="text-sm text-slate-500 font-medium">Disetujui</p>
            <p class="text-3xl font-bold text-slate-900 mt-2">{{ $jumlahDisetujui }}</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
            <p class="text-sm text-slate-500 font-medium">Ditolak</p>
            <p class="text-3xl font-bold text-slate-900 mt-2">{{ $jumlahDitolak }}</p>
        </div>
    </div>

    <!-- Detail Profil -->
    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pb-4 border-b border-slate-100">
            <div>
                <h2 class="text-base font-bold text-slate-900">Detail Profil</h2>
                <p class="text-xs text-slate-500 mt-0.5">Informasi akun dan identitas pengguna pada sistem SIPLUS.</p>
            </div>

            <div class="flex items-center gap-2.5">
                <span class="rounded-full bg-blue-50 border border-blue-100 px-3 py-1 text-xs font-semibold text-blue-600">
                    {{ $peranLabel }}
                </span>
                <a href="{{ $kelolaProfilUrl }}"
                   class="inline-flex items-center gap-1.5 rounded-xl bg-blue-600 hover:bg-blue-700 px-3.5 py-2 text-xs font-semibold text-white shadow-sm transition">
                    <span>Kelola Profil</span>
                    <span>&rarr;</span>
                </a>
            </div>
        </div>

        <dl class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-5 text-sm">
            <div class="rounded-xl bg-slate-50/80 border border-slate-100 px-4 py-3">
                <dt class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Nama Lengkap</dt>
                <dd class="mt-1 font-semibold text-slate-900">{{ $namaLengkap }}</dd>
            </div>

            <div class="rounded-xl bg-slate-50/80 border border-slate-100 px-4 py-3">
                <dt class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Email</dt>
                <dd class="mt-1 font-semibold text-slate-900 break-all">{{ $profilUser->email ?? '-' }}</dd>
            </div>

            <div class="rounded-xl bg-slate-50/80 border border-slate-100 px-4 py-3">
                <dt class="text-[11px] font-bold uppercase tracking-wider text-slate-400">NIM / NIP</dt>
                <dd class="mt-1 font-semibold text-slate-900">{{ $nimNip !== '' ? $nimNip : '-' }}</dd>
            </div>
        </dl>
    </div>

    <!-- Track Peminjaman & Riwayat yang Selesai -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h2 class="text-base font-bold text-slate-900">Track Peminjaman &amp; Riwayat</h2>
                <p class="text-xs text-slate-500 mt-0.5">Rekapitulasi pengajuan ruangan yang dilakukan maupun yang sudah selesai.</p>
            </div>
            <a href="{{ route('peminjaman.index') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700 inline-flex items-center gap-1">
                <span>Lihat Riwayat Lengkap</span>
                <span>&rsaquo;</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50/90 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="text-left px-6 py-3.5">Ruangan</th>
                        <th class="text-left px-6 py-3.5">Mata Kuliah / Keperluan</th>
                        <th class="text-left px-6 py-3.5">Tanggal</th>
                        <th class="text-center px-6 py-3.5">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse ($riwayatRows as $row)
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="px-6 py-4 font-semibold text-slate-900">
                                {{ $row['nama_ruang'] }}
                                @if ($row['kode_ruang'] !== '')
                                    <span class="block text-xs font-normal text-slate-500">{{ $row['kode_ruang'] }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-medium text-slate-800">{{ $row['matkul'] }}</span>
                                @if ($row['keperluan'] !== '')
                                    <span class="block text-xs text-slate-500 mt-0.5">{{ $row['keperluan'] }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-600">
                                {{ $row['tanggal'] }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $row['badge'] }}">
                                    {{ $row['status'] }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-slate-400 text-xs">
                                Belum ada riwayat peminjaman ruangan yang tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection