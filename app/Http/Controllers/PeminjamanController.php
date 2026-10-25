<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Ruangan;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    // Menampilkan riwayat peminjaman milik user yang sedang login
    public function index()
    {
        $peminjamans = Peminjaman::with('ruangan')->where('user_id', Auth::id())->get();
        return view('peminjaman.index', compact('peminjamans'));
    }

    // Menampilkan form pengajuan peminjaman ruangan
    public function create()
    {
        $ruangans = Ruangan::all(); // Mengambil data ruangan untuk pilihan di form
        return view('peminjaman.create', compact('ruangans'));
    }

    // Menyimpan data pengajuan peminjaman ke database
    public function store(Request $request)
    {
        $request->validate([
            'ruangan_id'      => 'required|exists:ruangans,id',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'keperluan'       => 'required|string',
        ]);

        Peminjaman::create([
            'user_id'         => Auth::id(), // ID mahasiswa yang sedang login
            'ruangan_id'      => $request->ruangan_id,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'keperluan'       => $request->keperluan,
            'status'          => 'Pending', // Status awal saat diajukan
        ]);

        return redirect('/peminjaman')->with('success', 'Pengajuan peminjaman ruangan berhasil dikirim!');
    }

    // Menampilkan seluruh daftar peminjaman yang masuk untuk Admin
public function adminIndex()
{
    $peminjamans = Peminjaman::with(['user', 'ruangan'])->get();
    return view('admin.peminjaman.index', compact('peminjamans'));
}

// Mengubah status peminjaman (Disetujui / Ditolak)
public function updateStatus(Request $request, $id)
{
    $peminjaman = Peminjaman::findOrFail($id);
    
    $request->validate([
        'status' => 'required|in:Disetujui,Ditolak',
    ]);

    $peminjaman->update([
        'status' => $request->status
    ]);

    return redirect()->back()->with('success', 'Status peminjaman berhasil diperbarui!');
}
}

