<?php

namespace App\Listeners;

use App\Enums\UserRoleEnum;
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
        $event->user->assignRole(UserRoleEnum::USER->name);
        $event->user->notify(new SignUpNotification());
    }
}
