<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    use ApiResponse;

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        // Remove the auth_token cookie
        $response = $this->sendResponse('', __('general.logout'));
        $response->withCookie(cookie()->forget('auth_token'));

        return $response;
    }
}
