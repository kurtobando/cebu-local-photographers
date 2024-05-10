<?php

namespace App\Listeners;

use App\Enums\UserRoleEnum;
use App\Events\UserSignUpEvent;
use App\Models\MessageLimit;
use App\Notifications\UserSignUpNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserSignUpListener implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(UserSignUpEvent $event): void
    {
        $event->user->assignRole(UserRoleEnum::USER->value);
        $event->user->notify(new UserSignUpNotification());
        $event->user->messageLimit()->create(['user_id' => $event->user->id, 'limit' => MessageLimit::DEFAULT_LIMIT]);
    }
}
