<?php

namespace App\Listeners;

use App\Events\PasswordReset;
use App\Notifications\PasswordResetNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPasswordResetNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PasswordReset  $event
     * @return void
     */
    public function handle(PasswordReset $event)
    {
        // Access the user object
        $user = $event->user;

        // Send a notification to the user (e.g., email notification)
        // You can use Laravel's notification system or any other method you prefer
        $user->notify(new PasswordResetNotification($user));
    }
}
