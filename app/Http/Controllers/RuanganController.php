<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RuanganController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q'));

        $ruangans = Ruangan::query()
            ->when($q !== '', function ($query) use ($q) {
                $like = '%'.strtolower($q).'%';
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

    public function create()
    {
        return view('ruangan.create');
    }

    public function store(Request $request)
    {
        Ruangan::create($this->validated($request));

        return redirect('/ruangan')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function edit(Ruangan $ruangan)
    {
        return view('ruangan.edit', compact('ruangan'));
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        $ruangan->update($this->validated($request, $ruangan));

        return redirect('/ruangan')->with('success', 'Data ruangan berhasil diperbarui.');
    }

    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();

        return redirect('/ruangan')->with('success', 'Ruangan berhasil dihapus.');
    }

    private function validated(Request $request, ?Ruangan $ruangan = null): array
    {
        return $request->validate([
            'kode_ruang' => ['required', 'string', 'max:20', Rule::unique('ruangans', 'kode_ruang')->ignore($ruangan?->id)],
            'nama_ruangan' => ['required', 'string', 'max:255'],
            'kapasitas' => ['required', 'integer', 'min:1', 'max:5000'],
            'lokasi' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'status' => ['required', Rule::in(array_keys(Ruangan::STATUS))],
        ]);
    }
}