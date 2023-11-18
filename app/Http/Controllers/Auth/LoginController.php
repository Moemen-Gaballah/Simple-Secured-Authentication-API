<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;

class LoginController extends Controller
{
    use ApiResponse;

    public function login(LoginRequest $request)
    { // TODO __invoke method
        if (Auth::attempt($request->validated())) {
            $user = Auth::user();
            $token = $user->createToken(env('AUTH_TOKEN', 'authToken')); // TODO Set In Config

            // Store the token in an encrypted HttpOnly cookie
            $response = $this->sendResponse(new UserResource($user));
            $response->withCookie(cookie('auth_token', $token->plainTextToken, env('EXPIRE_TOKEN', 60)));
            info($token->plainTextToken); // TODO Remove
            // Kill other tokens
            $user->tokens()->where('id', '!=', $token->accessToken->id)->delete();

            return $response;
        }

        return $this->sendError(__('general.Invalid credentials'), 401);
    }
}
