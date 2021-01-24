<?php

namespace App\Listeners;

use Mail;
use App\Events\UserRegisterEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserRegisterListen
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
     * @param  UserRegisterEvent  $event
     * @return void
     */
    public function handle(UserRegisterEvent $event)
    {
        $user = $event->user;
        $subject = "Welcome to " . env('APP_NAME') . " !";
        Mail::send('email.register_user', $user, function ($message) use ($user, $subject) {
            $message->to($user['email'])->subject($subject);
        });
    }
}
