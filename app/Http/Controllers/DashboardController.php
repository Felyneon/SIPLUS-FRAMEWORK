<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Role;
use App\Models\Ruangan;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $isPengelola = (int) session('user_role') === Role::PENGELOLA;

        if ($isPengelola) {
            $ringkasan = [
                'total_ruangan'    => Ruangan::count(),
                'ruangan_tersedia' => Ruangan::where('status', Ruangan::STATUS_TERSEDIA)->count(),
                'menunggu'         => Peminjaman::where('status', Peminjaman::STATUS_PENDING)->count(),
                'disetujui'        => Peminjaman::where('status', Peminjaman::STATUS_DISETUJUI)->count(),
            ];

            $terbaru = Peminjaman::with(['user', 'ruangan'])
                ->where('status', Peminjaman::STATUS_PENDING)
                ->oldest()
                ->take(5)
                ->get();
        } else {
            $milikSaya = Peminjaman::where('user_id', Auth::id());

            $ringkasan = [
                'total'     => (clone $milikSaya)->count(),
                'menunggu'  => (clone $milikSaya)->where('status', Peminjaman::STATUS_PENDING)->count(),
                'disetujui' => (clone $milikSaya)->where('status', Peminjaman::STATUS_DISETUJUI)->count(),
                'ditolak'   => (clone $milikSaya)->where('status', Peminjaman::STATUS_DITOLAK)->count(),
            ];

            $terbaru = Peminjaman::with('ruangan')
                ->where('user_id', Auth::id())
                ->latest()
                ->take(5)
                ->get();
        }

        $user = Auth::user();

        $ruangans = Ruangan::where('status', Ruangan::STATUS_TERSEDIA)
            ->orderBy('id', 'asc')
            ->take(3)
            ->get();

        return view('dashboard', compact('isPengelola', 'ringkasan', 'terbaru', 'user', 'ruangans'));
    }
}