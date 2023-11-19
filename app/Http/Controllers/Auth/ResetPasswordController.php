<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use function Symfony\Component\Translation\t;

class ResetPasswordController extends Controller
{
    use ApiResponse;

    // TODO Set Local To Header it is better OR use Package localization or ...
    public function reset(ResetPasswordRequest $request, $local, $token)
    {
        $passwordReset = \DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $token,
        ])->first();

        if (!$passwordReset) {
            return $this->sendResponse('', __('general.Unable to reset password'), 500);
        }

        User::where('email', $request->email)->update([
            'password' => bcrypt($request->password)
        ]);

        \DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $token,
        ])->delete();

        return $this->sendResponse('', __('general.Password reset successfully'));
    }


}
