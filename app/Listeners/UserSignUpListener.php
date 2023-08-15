<?php

namespace App\Listeners;

use App\Events\UserSignUpEvent;
use App\Notifications\SignUpNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserSignUpListener implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(UserSignUpEvent $event): void
    {
        $event->user->notify(new SignUpNotification());
    }
}
