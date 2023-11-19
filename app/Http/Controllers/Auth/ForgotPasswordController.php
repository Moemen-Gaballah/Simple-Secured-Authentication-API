<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendRestEmailRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use ApiResponse;
    public function sendResetLinkEmail(SendRestEmailRequest $request)
    {
//        $status = Password::sendResetLink(
//            $request->only('email'),
//        );
        $token = \Str::random(64);

        try{
        \DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        // TODO Queue
        \Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        } catch (\Exception $e){
            $this->sendError(__('general.Unable to send reset password link'), 500);
        }

        return $this->sendResponse('', __('general.Reset password link sent to your email'));
//        return $status === Password::RESET_LINK_SENT
//            ? $this->sendResponse('', __('general.Reset password link sent to your email'))
//            : $this->sendError(__('general.Unable to send reset password link'), 500);
    }

}
