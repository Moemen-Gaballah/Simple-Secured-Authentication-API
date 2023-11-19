<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendRestEmailRequest;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use ApiResponse;

    public function sendResetLinkEmail(SendRestEmailRequest $request)
    {
        $token = \Str::random(64);

        try {
            \DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            // TODO Queue
            $resetUrl = env('FRONT_URL') . "/password/reset/$token?email={$request->email}";
            \Mail::send('emails.password_reset', ['resetUrl' => $resetUrl], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject(__('general.Reset Password'));
            });

        } catch (\Exception $e) {
            $this->sendError(__('general.Unable to send reset password link'), 500);
        }

        return $this->sendResponse('', __('general.Reset password link sent to your email'));
    }

}
