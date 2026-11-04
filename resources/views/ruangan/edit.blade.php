@extends('layouts.app')

@section('title', 'Edit Ruangan')
@section('breadcrumb', 'Edit Ruangan')

@section('content')
<h1 class="text-2xl font-bold mb-1">Edit Ruangan</h1>
<p class="text-sm text-slate-500 mb-5">Perbarui data ruangan {{ $ruangan->kode_ruang }}.</p>

<form method="POST" action="/ruangan/{{ $ruangan->id }}" class="bg-white rounded-xl border border-slate-200 p-6 max-w-3xl">
    @csrf
    @method('PUT')
    @include('ruangan._form')
</form>
@endsection