<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AttachTokenFromCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $token = Session::get('token');   
        if ($token) {
            $request->headers->set('Authorization', 'Bearer ' . $token);
        }

        return $next($request);
    }

    public static function updateToken()
{
    try {
        $response = Http::post(route("refresh-token"), [
            'refresh_token' => Session::get('refresh_token'), 
        ]);

        if ($response->ok()) {
            $newToken = $response->json()['access_token'];

            Session::put('token', $newToken);

            return $newToken;
        } else {
            throw new \Exception('Não foi possível atualizar o token.');
        }
    } catch (\Exception $e) {
        return null;
    }
}
}
