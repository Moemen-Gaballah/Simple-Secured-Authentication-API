<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        // Remove the auth_token cookie
        $response = new Response('Logout successful');
        $response->withCookie(cookie()->forget('auth_token'));

        return $response;
    }
}
