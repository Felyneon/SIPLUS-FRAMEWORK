<?php

namespace App\Http\Controllers;

use App\Http\Requests\RuanganRequest;
use App\Models\Peminjaman;
use App\Models\Ruangan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class RuanganController extends Controller
{
    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q'));

        $ruangans = Ruangan::query()
            ->when($q !== '', function ($query) use ($q) {
                $like = '%' . strtolower($q) . '%';
                $query->where(function ($w) use ($like) {
                    $w->whereRaw('LOWER(nama_ruangan) LIKE ?', [$like])
                        ->orWhereRaw('LOWER(kode_ruang) LIKE ?', [$like])
                        ->orWhereRaw('LOWER(lokasi) LIKE ?', [$like]);
                });
            })
            ->orderBy('kode_ruang')
            ->paginate(10)
            ->withQueryString();

        $user = Auth::user();
        $isPengelola = $user && (isset($user->role) && $user->role === 'admin' || (int)($user->is_pengelola ?? 0) === 1);

        return view('ruangan.index', compact('ruangans', 'q', 'user', 'isPengelola'));
    }

    public function create(): View
    {
        $user = Auth::user();
        $isPengelola = true;

        return view('ruangan.create', compact('user', 'isPengelola'));
    }

    public function store(RuanganRequest $request): RedirectResponse
    {
        Ruangan::create($request->validated());

        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function edit(Ruangan $ruangan): View
    {
        $user = Auth::user();
        $isPengelola = true;

        return view('ruangan.edit', compact('ruangan', 'user', 'isPengelola'));
    }

    public function update(RuanganRequest $request, Ruangan $ruangan): RedirectResponse
    {
        $ruangan->update($request->validated());

        return redirect()->route('ruangan.index')->with('success', 'Data ruangan berhasil diperbarui.');
    }

    public function destroy(Ruangan $ruangan): RedirectResponse
    {
        if (Peminjaman::where('ruangan_id', $ruangan->id)->exists()) {
            return redirect()->route('ruangan.index')->with(
                'error',
                'Ruangan memiliki riwayat peminjaman dan tidak dapat dihapus. Ubah statusnya menjadi Pemeliharaan.'
            );
        }

        $ruangan->delete();

        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil dihapus.');
    }
}