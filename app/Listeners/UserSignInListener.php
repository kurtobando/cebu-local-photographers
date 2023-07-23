<?php

namespace App\Listeners;

use App\Events\UserSignInEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class UserSignInListener implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(UserSignInEvent $event): void
    {
        // TODO!
        // sends email notification to user email address

        Log::debug($event->user->email);
        Log::debug("TODO! send sign in email to user");
    }
}
