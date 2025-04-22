<?php
use App\Exceptions\AuthenticationException;
use App\Exceptions\BusinessException;
use App\Exceptions\ValidatorAdapterException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->dontReport([
            BusinessException::class,
            ValidatorAdapterException::class,
            AuthenticationException::class
        ]);
    })->create();
