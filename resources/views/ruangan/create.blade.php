@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-semibold mb-4">Tambah Ruangan</h1>

    <form action="{{ route('ruangan.store') }}" method="POST">
        @csrf

        @include('ruangan._form')

        <div class="mt-5 flex gap-3">
            <button type="submit">Simpan Ruangan</button>
            <a href="{{ route('ruangan.index') }}">Batal</a>
        </div>
    </form>
@endsection