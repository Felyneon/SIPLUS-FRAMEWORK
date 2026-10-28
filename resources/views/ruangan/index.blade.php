<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ruangan SIPLUS</title>
</head>
<body>
    <h1>Daftar Ruangan Fakultas Vokasi</h1>
    
    <ul>
        @foreach ($ruangans as $r)
            <li>
                <strong>{{ $r->nama_ruangan }}</strong> - 
                Kapasitas: {{ $r->kapasitas }} orang 
                (Lokasi: {{ $r->lokasi }})
            </li>
        @endforeach
    </ul>
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