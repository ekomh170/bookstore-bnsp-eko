<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

/*
|--------------------------------------------------------------------------
| Bootstrap Application Configuration
|--------------------------------------------------------------------------
| File ini mengatur konfigurasi utama aplikasi Laravel termasuk routing,
| middleware, dan exception handling untuk Bookstore BNSP Eko Haryono
*/

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        /**
         * Register Middleware Aliases
         * Middleware 'admin' digunakan untuk memproteksi route-route admin
         * seperti dashboard, CRUD buku, kategori, dan manajemen user
         */
        $middleware->alias([
            'admin' => \App\Http\Middleware\IsAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        /**
         * Custom Exception Handling
         * Tambahkan custom error handling di sini jika diperlukan
         */
    })->create();
