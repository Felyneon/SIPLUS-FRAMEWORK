<?php

namespace App\Http\Controllers;

use App\Http\Requests\RuanganRequest;
use App\Models\Peminjaman;
use App\Models\Ruangan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RuanganController extends Controller
{
    // GET /ruangan (pengelola dan mahasiswa)
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

        return view('ruangan.index', compact('ruangans', 'q'));
    }

    // GET /ruangan/tambah (pengelola)
    public function create(): View
    {
        return view('ruangan.create');
    }

    // POST /ruangan (pengelola)
    public function store(RuanganRequest $request): RedirectResponse
    {
        Ruangan::create($request->validated());

        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    // GET /ruangan/{ruangan}/edit (pengelola)
    public function edit(Ruangan $ruangan): View
    {
        return view('ruangan.edit', compact('ruangan'));
    }

    // PUT /ruangan/{ruangan} (pengelola)
    public function update(RuanganRequest $request, Ruangan $ruangan): RedirectResponse
    {
        $ruangan->update($request->validated());

        return redirect()->route('ruangan.index')->with('success', 'Data ruangan berhasil diperbarui.');
    }

    // DELETE /ruangan/{ruangan} (pengelola)
    public function destroy(Ruangan $ruangan): RedirectResponse
    {
        // FK peminjaman memakai onDelete('cascade'): menghapus ruangan akan menghapus seluruh riwayatnya
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