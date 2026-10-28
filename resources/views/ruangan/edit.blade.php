{{-- resources/views/ruangan/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4" style="max-width:600px">
    <h4 class="mb-3">Edit Ruangan</h4>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('ruangan.update', $ruangan) }}" method="POST">
                @csrf
                @method('PUT')
                @include('ruangan._form', ['ruangan' => $ruangan])
            </form>
        </div>
    </div>
</div>
@endsection