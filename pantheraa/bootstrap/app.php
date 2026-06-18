<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Unauthenticated visitors to /admin/* are sent to the admin login.
        $middleware->redirectGuestsTo('/admin/login');

        // Apply admin-managed 301/302 redirects on every request (even unrouted paths).
        $middleware->prepend(\App\Http\Middleware\HandleRedirects::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create()
    // Shared-hosting layout: public assets (build/, images/, uploads/) live in the
    // web root one level above this app folder, so point the public path there.
    ->usePublicPath(dirname(__DIR__, 2));
