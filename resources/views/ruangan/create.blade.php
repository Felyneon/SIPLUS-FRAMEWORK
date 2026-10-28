<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Ruangan SIPLUS</title>
</head>
<body>
    <h1>Tambah Ruangan Vokasi Baru</h1>

    {{-- Form wajib menggunakan @csrf untuk keamanan di Laravel --}}
    <form action="/ruangan" method="POST">
        @csrf
        <div>
            <label>Nama Ruangan:</label><br>
            <input type="text" name="nama_ruangan" required>
        </div>
        <br>
        <div>
            <label>Kapasitas (Orang):</label><br>
            <input type="number" name="kapasitas" required>
        </div>
        <br>
        <div>
            <label>Lokasi Gedung:</label><br>
            <input type="text" name="lokasi" required>
        </div>
        <br>
        <div>
            <label>Deskripsi:</label><br>
            <textarea name="deskripsi"></textarea>
        </div>
        <br>
        <button type="submit">Simpan Ruangan</button>
    </form>
    
    <br>
    <a href="/ruangan">Kembali ke Daftar Ruangan</a>
</body>
</html>
{{-- resources/views/ruangan/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4" style="max-width:600px">
    <h4 class="mb-3">Tambah Ruangan</h4>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('ruangan.store') }}" method="POST">
                @csrf
                @include('ruangan._form')
            </form>
        </div>
    </div>
</div>
@endsection