<?php

use GuzzleHttp\Psr7\Request;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Session\Middleware\StartSession;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(StartSession::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->render(function (AuthenticationException $e, Request $request) {
            var_dump("sddsdssd");
            exit;
            if ($request->is('web/*')) {
                return redirect()->route('login'); // Substitua 'login' pela rota de login que deseja redirecionar
            }
            return response()->json(['message' => 'Unauthorized'], 401);
        });
    })->create();
