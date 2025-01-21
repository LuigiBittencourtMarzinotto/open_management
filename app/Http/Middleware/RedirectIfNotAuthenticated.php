<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class RedirectIfNotAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = Session::get('token');
        if (!$token) {
            if (!$request->expectsJson()) {
                return redirect()->route('login');
            }
    
            return response()->json(['message' => 'Requisição não autorizada'], 401);
        }
    
        try {
            $user = JWTAuth::setToken($token)->authenticate();
    
            if (!$user) {
                return redirect()->route('login');
            }
        } catch (JWTException $e) {
            if (!$request->expectsJson()) {
                return redirect()->route('login');
            }
            
            return response()->json(['message' => 'Token inválido ou expirado'], 401);
        }
    
        return $next($request);
    }
}
