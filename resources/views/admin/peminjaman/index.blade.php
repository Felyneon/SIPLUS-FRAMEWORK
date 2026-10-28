<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Persetujuan Peminjaman Ruangan SIPLUS</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f9f9f9; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; background: white; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #1e3a8a; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .btn-setuju { background-color: #22c55e; color: white; border: none; padding: 6px 12px; cursor: pointer; border-radius: 4px; }
        .btn-tolak { background-color: #ef4444; color: white; border: none; padding: 6px 12px; cursor: pointer; border-radius: 4px; }
        .badge-pending { color: #d97706; font-weight: bold; }
        .badge-disetujui { color: #16a34a; font-weight: bold; }
        .badge-ditolak { color: #dc2626; font-weight: bold; }
        .alert-success { color: green; margin-bottom: 15px; font-weight: bold; }
    </style>
</head>
<body>

    <h1>Panel Admin: Daftar Pengajuan Peminjaman Ruangan</h1>
    <p><a href="/dashboard">← Kembali ke Dashboard</a></p>

    {{-- Pesan Sukses jika status berhasil diubah --}}
    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Nama Ruangan</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Keperluan</th>
                <th>Status</th>
                <th>Aksi / Persetujuan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjamans as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    {{-- Mengambil data nama user dan ruangan melalui relasi Eloquent Model --}}
                    <td>{{ $p->user->name ?? 'User Tidak Ditemukan' }}</td>
                    <td>{{ $p->ruangan->nama_ruangan ?? 'Ruangan Tidak Ditemukan' }}</td>
                    <td>{{ $p->tanggal_mulai }}</td>
                    <td>{{ $p->tanggal_selesai }}</td>
                    <td>{{ $p->keperluan }}</td>
                    <td>
                        <span class="
                            @if($p->status == 'Pending') badge-pending 
                            @elseif($p->status == 'Disetujui') badge-disetujui 
                            @else badge-ditolak 
                            @endif">
                            {{ $p->status }}
                        </span>
                    </td>
                    <td>
                        {{-- Form untuk menyetujui peminjaman --}}
                        <form action="/admin/peminjaman/{{ $p->id }}/status" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="status" value="Disetujui">
                            <button type="submit" class="btn-setuju" onclick="return confirm('Setujui peminjaman ini?')">Setuju</button>
                        </form>

                        {{-- Form untuk menolak peminjaman --}}
                        <form action="/admin/peminjaman/{{ $p->id }}/status" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="status" value="Ditolak">
                            <button type="submit" class="btn-tolak" onclick="return confirm('Tolak peminjaman ini?')">Tolak</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">Belum ada pengajuan peminjaman ruangan yang masuk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
{{-- resources/views/admin/peminjaman/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h4 class="mb-3">Persetujuan Peminjaman Ruangan</h4>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif

    {{-- Filter status --}}
    <ul class="nav nav-pills mb-3">
        <li class="nav-item">
            <a class="nav-link {{ !request('status') ? 'active' : '' }}"
               href="{{ route('admin.peminjaman.index') }}">Semua</a>
        </li>
        @foreach (['Pending' => 'warning', 'Disetujui' => 'success', 'Ditolak' => 'danger'] as $s => $warna)
            <li class="nav-item">
                <a class="nav-link {{ request('status') === $s ? 'active' : '' }}"
                   href="{{ route('admin.peminjaman.index', ['status' => $s]) }}">
                    {{ $s }} <span class="badge bg-{{ $warna }}">{{ $jumlah[$s] }}</span>
                </a>
            </li>
        @endforeach
    </ul>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Peminjam</th>
                        <th>Ruangan</th>
                        <th>Jadwal Peminjaman</th>
                        <th>Keperluan</th>
                        <th>Status</th>
                        <th class="text-center" style="width:200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($peminjamans as $p)
                        <tr>
                            <td>{{ $peminjamans->firstItem() + $loop->index }}</td>
                            <td>{{ $p->user->name ?? '-' }}</td>
                            <td>{{ $p->ruangan->nama_ruangan ?? '-' }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($p->tanggal_mulai)->format('d M Y H:i') }}
                                <br><small class="text-muted">s/d {{ \Carbon\Carbon::parse($p->tanggal_selesai)->format('d M Y H:i') }}</small>
                            </td>
                            <td>{{ $p->keperluan }}</td>
                            <td>
                                @php
                                    $badge = ['Pending' => 'warning text-dark', 'Disetujui' => 'success', 'Ditolak' => 'danger'][$p->status] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $badge }}">{{ $p->status }}</span>
                            </td>
                            <td class="text-center">
                                @if ($p->status === 'Pending')
                                    <form action="{{ route('admin.peminjaman.status', $p) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="Disetujui">
                                        <button class="btn btn-sm btn-success"
                                                onclick="return confirm('Setujui peminjaman ini?')">✓ Setujui</button>
                                    </form>
                                    <form action="{{ route('admin.peminjaman.status', $p) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="Ditolak">
                                        <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Tolak peminjaman ini?')">✗ Tolak</button>
                                    </form>
                                @else
                                    <span class="text-muted small">Sudah diproses</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted py-4">Belum ada pengajuan peminjaman.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">{{ $peminjamans->links() }}</div>
</div>
@endsection