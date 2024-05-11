<?php

namespace App\Listeners;

use App\Events\PasswordConfirmationEvent;
use App\Notifications\PasswordConfirmationNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordConfirmationListener implements ShouldQueue
{
    public function __construct()
    {
    }

    public function handle(PasswordConfirmationEvent $event): void
    {
        $event->user->notify(new PasswordConfirmationNotification());
    }
}
