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
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        if ((int) session('user_role') === Role::PENGELOLA) {
            return $next($request);
        }

        return redirect()->route('dashboard')
            ->with('error', 'Akses ditolak. Anda tidak memiliki izin.');
    }
}