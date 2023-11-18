<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    use ApiResponse;

    public function reset(ResetPasswordRequest $request, $token)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? $this->sendResponse('', __('general.Password reset successfully'))
            : $this->sendResponse('', __('general.Unable to reset password'), 500);
    }

}
