<?php

namespace App\Listeners;

use App\Events\PasswordResetEvent;
use App\Notifications\PasswordResetNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordResetListener implements ShouldQueue
{

    public function __construct()
    {
        //
    }

    public function handle(PasswordResetEvent $event): void
    {
        $event->user->notify(new PasswordResetNotification($event->token, $event->user->email));
    }
}
