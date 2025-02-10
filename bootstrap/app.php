<?php

use App\Http\Middleware\CustomCors;
use Illuminate\Foundation\Application;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            'v1/*',
        ]);

        $middleware->append(CustomCors::class);

        $middleware->alias([
            'sanctum' => EnsureFrontendRequestsAreStateful::class,
            'cors' => CustomCors::class,
        ]);        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
