
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">
            Kelola Pengguna
        </h1>
        <p class="text-slate-500 mt-1">
            Kelola data pengguna SIPLUS.
        </p>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-50 p-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl border border-slate-200 p-5">

        <form method="GET"
              action="{{ url('/admin/pengguna') }}"
              class="mb-5 flex gap-2">

            <input
                type="text"
                name="q"
                value="{{ $q ?? '' }}"
                placeholder="Cari nama atau email pengguna..."
                class="w-full rounded-lg border border-slate-300 px-4 py-2"
            >

            <button type="submit"
                class="rounded-lg bg-blue-600 px-5 py-2 text-white">
                Cari
            </button>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="p-3">No.</th>
                        <th class="p-3">Nama</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">ID Pengguna</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($users as $user)
                        <tr class="border-t border-slate-100">
                            <td class="p-3">
                                {{ $loop->iteration }}
                            </td>

                            <td class="p-3 font-medium text-slate-800">
                                {{ $user->name }}
                            </td>

                            <td class="p-3 text-slate-600">
                                {{ $user->email }}
                            </td>

                            <td class="p-3 text-slate-600">
                                {{ $user->id }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4"
                                class="p-6 text-center text-slate-400">
                                Belum ada pengguna.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            {{ $users->links() }}
        </div>

    </div>
</div>
@endsection
