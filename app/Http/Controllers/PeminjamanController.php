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
public function store(Request $request)
{
    // 1. Validasi data input dari form
    $request->validate([
        'nama_matkul' => 'required|string',
        'dosen_pengampu' => 'required|string',
        'nama_pjmk' => 'required|string',
        'prodi' => 'required|string',
        'gedung' => 'required|string',
        'ruangan_id' => 'required|string',
        'tanggal' => 'required|date',
        'alasan' => 'nullable|string',
    ]);

    \App\Models\Peminjaman::create([
        'user_id' => Auth::id(), 
        'mata_kuliah' => $request->nama_matkul,
        'dosen_pengampu' => $request->dosen_pengampu,
        'nama_pjmk' => $request->nama_pjmk,
        'prodi' => $request->prodi,
        'gedung' => $request->gedung,
        'ruangan_id' => $request->ruangan_id,
        'tanggal' => $request->tanggal,
        'alasan' => $request->alasan,
        'status' => 'Menunggu', 
    ]);

    // 3. Redirect kembali ke halaman status dengan pesan sukses
    return redirect('/peminjaman')->with('success', 'Pengajuan berhasil dikirim!');
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

