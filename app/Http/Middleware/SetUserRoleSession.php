<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetUserRoleSession
{
    /**
     * Pengguna yang masuk lewat cookie "Remember me" tidak melewati AuthController@login,
     * sehingga session('user_role') kosong. Middleware ini mengisinya kembali.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && ! session()->has('user_role')) {
            session(['user_role' => Auth::user()->roleId()]);
        }

        return $next($request);
    }
}