<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isAdministrator
{
    public function handle(Request $request, Closure $next): Response
    {

    // Pastikan pengguna sudah login.
    if (! Auth::check()) {
        return redirect()->route('login');
    }

    // Ambil role langsung dari database melalui user yang login.
    $user = Auth::user();
    $roleId = (int) $user->roleId();

    // Sinkronkan session dengan role dari database.
    $request->session()->put('user_role', $roleId);

    // Hanya role Pengelola (1) yang boleh masuk.
    if ($roleId !== \App\Models\Role::PENGELOLA) {
        abort(403, 'Akses ditolak. Halaman ini hanya untuk Pengelola.');
    }

    return $next($request);
}

}

