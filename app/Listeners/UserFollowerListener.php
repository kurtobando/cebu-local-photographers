<?php

namespace App\Listeners;

use App\Events\UserFollowerEvent;
use App\Notifications\UserFollowerNewNotification;

class UserFollowerListener
{
    public function __construct()
    {
        //
    }

    public function handle(UserFollowerEvent $event): void
    {
        $event
            ->userFollower
            ->user
            ->notify(new UserFollowerNewNotification($event->userFollower->userFollower));
    }
}
