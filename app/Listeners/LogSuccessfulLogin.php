<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = $event->user;
        // Log::info('User logged in: ' . $user->email);
        $ipAddress = request()->ip(); // Get the user's IP address
        Log::channel('auth_log')->info('User logged in successfully: ' . 'user_id: ' . $user->id . ', Username: ' . $user->name . ', Email: ' . $user->email . ' from IP: ' . $ipAddress);
    }
}
