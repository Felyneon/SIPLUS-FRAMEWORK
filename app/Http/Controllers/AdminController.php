<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Role;
use App\Models\Ruangan;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\View\View;

class AdminController extends Controller
{
    // GET /admin/dashboard (pengelola)
    public function index(): View
    {
        $ringkasan = [
            'pengguna'  => User::count(),
            'mahasiswa' => UserRole::where('role_id', Role::MAHASISWA)->count(),
            'pengelola' => UserRole::where('role_id', Role::PENGELOLA)->count(),
            'ruangan'   => Ruangan::count(),
            'menunggu'  => Peminjaman::where('status', Peminjaman::STATUS_PENDING)->count(),
        ];

        $menunggu = Peminjaman::with(['user', 'ruangan'])
            ->where('status', Peminjaman::STATUS_PENDING)
            ->oldest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('ringkasan', 'menunggu'));
    }
}