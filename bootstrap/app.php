<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
   ->withMiddleware(function (Middleware $middleware): void {
    $middleware->alias([
        'isAdministrator' => \App\Http\Middleware\isAdministrator::class,
        'role'            => \App\Http\Middleware\CheckRole::class,
    ]);

    // Dijalankan pada setiap request grup web, setelah session dimulai
    $middleware->web(append: [
        \App\Http\Middleware\SetUserRoleSession::class,
    ]);

    // Pengguna yang sudah login dan membuka /login dialihkan ke dashboard
    $middleware->redirectUsersTo('/dashboard');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
    