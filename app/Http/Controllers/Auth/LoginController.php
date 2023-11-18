<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request){
        if (Auth::attempt($request->validated())) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            // Store the token in an encrypted HttpOnly cookie
            $response = new Response('Login successful');
            $response->withCookie(cookie('auth_token', $token, 60, null, null, true, true));

            // Kill other tokens
            $user->tokens()->where('id', '!=', $user->currentAccessToken()->id)->delete();

            return $response;
        }

        return response('Invalid credentials', 401);
    }
}
