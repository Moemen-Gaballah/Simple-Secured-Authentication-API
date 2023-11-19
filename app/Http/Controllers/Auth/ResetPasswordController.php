<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    use ApiResponse;

    // TODO Set Local To Header it is better OR use Package localization or ...
    public function reset(ResetPasswordRequest $request, $local, $token)
    {
        $credentials = $request->only('email', 'password', 'password_confirmation');
        $credentials['token'] = $token;
        $status = Password::reset(
            $credentials,
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? $this->sendResponse('', __('general.Password reset successfully'))
            : $this->sendResponse('', __('general.Unable to reset password'), 500);
    }

}
