@extends('layouts.app')

@section('title', 'Tambah Ruangan')
@section('breadcrumb', 'Tambah Ruangan')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Tambah Ruangan</h1>
            <p class="text-sm text-slate-500 mt-1">Tambahkan data ruang kelas, laboratorium, atau aula Fakultas Vokasi UNAIR.</p>
        </div>
        <a href="{{ route('ruangan.index') }}" class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">
            ← Kembali ke Daftar
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            <p class="font-semibold mb-1">Periksa kembali isian form:</p>
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white border border-slate-200 rounded-xl p-6">
        <form action="{{ route('ruangan.store') }}" method="POST">
            @csrf

            @include('ruangan._form')

            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('ruangan.index') }}" class="rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                    Batal
                </a>
                <button type="submit" class="rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-800">
                    Simpan Ruangan
                </button>
            </div>
        </form>
    </div>
@endsection