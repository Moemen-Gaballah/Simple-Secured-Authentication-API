<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SetTokenFromCookie
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $cookieAuthToken = $request->cookie('auth_token');

        if ($cookieAuthToken) {

            $token = Crypt::decryptString($cookieAuthToken, false);
            $token = substr(strstr($token, "|"), 1);
            $request->headers->set('Authorization', 'Bearer ' . $token);

        }

        return $next($request);
    }
}
