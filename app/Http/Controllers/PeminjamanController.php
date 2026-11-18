<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePeminjamanRequest;
use App\Http\Requests\UpdateStatusPeminjamanRequest;
use App\Models\Peminjaman;
use App\Models\Ruangan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PeminjamanController extends Controller
{
    // GET /peminjaman : riwayat milik pengguna yang login
    public function index(Request $request): View
    {
        $status = $this->statusFilter($request);
        $user = Auth::user();
        $isPengelola = (int) session('user_role') === 1;

        $peminjamans = Peminjaman::with('ruangan')
            ->where('user_id', Auth::id())
            ->when($status, fn ($query) => $query->where('status', $status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('peminjaman.index', compact('peminjamans', 'status', 'user', 'isPengelola'));
    }

    // GET /peminjaman/tambah : form pengajuan
    public function create(Request $request): View
    {
        $user = Auth::user();
        $isPengelola = (int) session('user_role') === 1;

        // Menangkap parameter ruangan_id yang dikirim dari tombol "Pinjam" di dashboard
        $ruanganId = $request->query('ruangan_id');
        
        // Mengambil data ruangan yang dipilih, atau mengambil data pertama sebagai fallback jika kosong
        $ruanganDipilih = Ruangan::find($ruanganId) ?? Ruangan::first();

        return view('peminjaman.create', compact('ruanganDipilih', 'user', 'isPengelola'));
    }

    // POST /peminjaman : simpan pengajuan
    public function store(StorePeminjamanRequest $request): RedirectResponse
    {
        Peminjaman::create([
            ...$request->validated(),
            'user_id' => Auth::id(),
            'status'  => Peminjaman::STATUS_PENDING,
        ]);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Pengajuan peminjaman ruangan berhasil dikirim!');
    }

    // DELETE /peminjaman/{peminjaman} : membatalkan pengajuan milik sendiri
    public function destroy(Peminjaman $peminjaman): RedirectResponse
    {
        abort_unless((int) $peminjaman->user_id === (int) Auth::id(), 403);

        if ($peminjaman->status !== Peminjaman::STATUS_PENDING) {
            return back()->with('error', 'Hanya pengajuan berstatus Pending yang dapat dibatalkan.');
        }

        $peminjaman->delete();

        return back()->with('success', 'Pengajuan berhasil dibatalkan.');
    }

    // GET /admin/peminjaman : seluruh pengajuan (pengelola)
    public function adminIndex(Request $request): View
    {
        $status = $this->statusFilter($request);

        $peminjamans = Peminjaman::with(['user', 'ruangan'])
            ->when($status, fn ($query) => $query->where('status', $status))
            ->orderByRaw("CASE status WHEN 'Pending' THEN 0 ELSE 1 END")   // Pending paling atas
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $ringkasan = Peminjaman::selectRaw('status, COUNT(*) AS total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('admin.peminjaman.index', compact('peminjamans', 'status', 'ringkasan'));
    }

    // POST /admin/peminjaman/{peminjaman}/status : setuju atau tolak (pengelola)
    public function updateStatus(UpdateStatusPeminjamanRequest $request, Peminjaman $peminjaman): RedirectResponse
    {
        $status = $request->validated('status');

        $peminjaman->update([
            'status'           => $status,
            'alasan_penolakan' => $status === Peminjaman::STATUS_DITOLAK
                ? $request->validated('alasan_penolakan')
                : null,
        ]);

        return back()->with('success', "Pengajuan berhasil diubah menjadi {$status}.");
    }

    // Filter ?status=... hanya diterima bila termasuk daftar status yang sah
    private function statusFilter(Request $request): ?string
    {
        $status = $request->query('status');

        return in_array($status, Peminjaman::STATUS, true) ? $status : null;
    }
}