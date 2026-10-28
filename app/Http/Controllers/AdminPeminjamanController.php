<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class AdminPeminjamanController extends Controller
{
    /**
     * Panel verifikasi: daftar semua pengajuan peminjaman.
     * Filter: ?status=Pending|Disetujui|Ditolak
     */
    public function adminIndex(Request $request)
    {
        $peminjamans = Peminjaman::with(['user', 'ruangan'])
            ->when($request->status, fn ($q, $status) => $q->where('status', $status))
            // CASE dipakai (bukan FIELD) supaya jalan di MySQL maupun SQLite
            ->orderByRaw("CASE status WHEN 'Pending' THEN 0 WHEN 'Disetujui' THEN 1 ELSE 2 END")
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $jumlah = [
            'Pending'   => Peminjaman::where('status', 'Pending')->count(),
            'Disetujui' => Peminjaman::where('status', 'Disetujui')->count(),
            'Ditolak'   => Peminjaman::where('status', 'Ditolak')->count(),
        ];

        return view('admin.peminjaman.index', compact('peminjamans', 'jumlah'));
    }

    /**
     * Ubah status peminjaman menjadi Disetujui / Ditolak.
     */
    public function updateStatus(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'status' => 'required|in:Disetujui,Ditolak',
        ]);

        if ($peminjaman->status !== 'Pending') {
            return back()->with('error', 'Pengajuan ini sudah diproses sebelumnya.');
        }

        // Saat menyetujui, pastikan tidak bentrok dengan peminjaman lain yang sudah disetujui
        if ($request->status === 'Disetujui') {
            $bentrok = Peminjaman::where('ruangan_id', $peminjaman->ruangan_id)
                ->where('id', '!=', $peminjaman->id)
                ->where('status', 'Disetujui')
                ->where('tanggal_mulai', '<', $peminjaman->tanggal_selesai)
                ->where('tanggal_selesai', '>', $peminjaman->tanggal_mulai)
                ->exists();

            if ($bentrok) {
                return back()->with('error', 'Jadwal bentrok dengan peminjaman lain yang sudah disetujui.');
            }
        }

        $peminjaman->update(['status' => $request->status]);

        return back()->with('success', "Pengajuan berhasil {$request->status}.");
    }
}