<?php

namespace App\Listeners;

use App\Events\UserSignInEvent;
use App\Notifications\UserSignInNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserSignInListener implements ShouldQueue
{
    public function __construct()
    {
    }

    public function handle(UserSignInEvent $event): void
    {
        $event
            ->user
            ->notify(new UserSignInNotification($event->clientIpAddress, $event->userAgent));
    }
}
