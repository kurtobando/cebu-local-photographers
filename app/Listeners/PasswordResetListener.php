<?php

namespace App\Listeners;

use App\Events\PasswordResetEvent;
use App\Models\User;
use App\Notifications\PasswordResetNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordResetListener implements ShouldQueue
{

    public function __construct(private readonly User $user)
    {
        //
    }

    public function handle(PasswordResetEvent $event): void
    {
        $email = $event->passwordResetToken->email;
        $token = $event->passwordResetToken->token;

        $this->user->where('email', $email)->first()->notify(new PasswordResetNotification($token, $email));
    }
}
