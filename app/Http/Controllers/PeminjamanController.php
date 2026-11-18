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

    public function create(Request $request): View
    {
        $user = Auth::user();
        $isPengelola = (int) session('user_role') === 1;
        $ruanganId = $request->query('ruangan_id');
        $ruanganDipilih = Ruangan::find($ruanganId) ?? Ruangan::first();

        return view('peminjaman.create', compact('ruanganDipilih', 'user', 'isPengelola'));
    }

    public function store(StorePeminjamanRequest $request): RedirectResponse
    {
        Peminjaman::create([
            ...$request->validated(),
            'user_id' => Auth::id(),
            'status'  => 'Pending', 
        ]);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Pengajuan peminjaman ruangan berhasil dikirim!');
    }

    public function destroy(Peminjaman $peminjaman): RedirectResponse
    {
        abort_unless((int) $peminjaman->user_id === (int) Auth::id(), 403);

        if ($peminjaman->status !== 'Pending') {
            return back()->with('error', 'Hanya pengajuan berstatus Pending yang dapat dibatalkan.');
        }

        $peminjaman->delete();

        return back()->with('success', 'Pengajuan berhasil dibatalkan.');
    }

    public function adminIndex(Request $request): View
    {
        $status = $this->statusFilter($request);

        $peminjamans = Peminjaman::with(['user', 'ruangan'])
            ->when($status, fn ($query) => $query->where('status', $status))
            ->orderByRaw("CASE status WHEN 'Pending' THEN 0 ELSE 1 END")
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $ringkasan = Peminjaman::selectRaw('status, COUNT(*) AS total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('admin.peminjaman.index', compact('peminjamans', 'status', 'ringkasan'));
    }

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

    private function statusFilter(Request $request): ?string
    {
        $status = $request->query('status');

        return in_array($status, Peminjaman::STATUS, true) ? $status : null;
    }
}