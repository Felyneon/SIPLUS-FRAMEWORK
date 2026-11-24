<?php

namespace App\Providers;

use App\Models\Peminjaman;
use App\Models\Role;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Tersedia di semua view tanpa dikirim dari controller
        View::share('namaSistem', config('siplus.nama'));

        // $isPengelola tersedia di semua view
        View::composer('*', function ($view) {
            $view->with('isPengelola', (int) session('user_role') === Role::PENGELOLA);
        });

        // Lencana jumlah pengajuan menunggu di menu, hanya untuk pengelola
        View::composer('layouts.app', function ($view) {
            if ((int) session('user_role') === Role::PENGELOLA) {
                $view->with('jumlahMenunggu', Peminjaman::where('status', Peminjaman::STATUS_PENDING)->count());
            }
        });
    }
}