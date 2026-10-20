<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;

class RuanganController extends Controller
{
    public function index()
    {
        // Mengambil seluruh data ruangan dari database PostgreSQL
        $ruangans = Ruangan::all();

        // Mengirim data ke view
        return view('ruangan.index', compact('ruangans'));
    }

    public function create()
{
    return view('ruangan.create');
}

public function store(Request $request)
{
    // Validasi input dari form
    $request->validate([
        'nama_ruangan' => 'required|string|max:255',
        'kapasitas'    => 'required|integer',
        'lokasi'       => 'required|string|max:255',
    ]);

    // Simpan ke database menggunakan Model Ruangan
    Ruangan::create([
        'nama_ruangan' => $request->nama_ruangan,
        'kapasitas'    => $request->kapasitas,
        'lokasi'       => $request->lokasi,
        'deskripsi'    => $request->deskripsi,
    ]);

    // Redirect kembali ke halaman daftar ruangan dengan pesan sukses
    return redirect('/ruangan')->with('success', 'Ruangan baru berhasil ditambahkan!');
}
}


