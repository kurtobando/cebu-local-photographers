<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordConfirmationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail(): MailMessage
    {
        return (new MailMessage())
            ->subject('Your Password Changed Successfully')
            ->line('You are receiving this email because you have successfully changed your password.')
            ->line('If you did not change your password, please contact us immediately.');
    }

    public function toArray(): array
    {
        return [
            //
        ];
    }
}
