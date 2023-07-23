<?php

namespace App\Listeners;

use App\Events\UserSignUpEvent;
use Illuminate\Support\Facades\Log;

class UserSignUpListener
{
    public function __construct()
    {
        //
    }

    public function handle(UserSignUpEvent $event): void
    {
        // TODO! sends email notification to user email address

        Log::debug($event->user->email);
        Log::debug("TODO! send sign up email to user");
    }
}
