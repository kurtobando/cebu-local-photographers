<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SignUpNotification extends Notification implements ShouldQueue
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
        return (new MailMessage)
            ->subject('Welcome to ' . config('app.name'))
            ->line('Congratulations! You have successfully signed up to ' . config('app.name') . '. Thank you for joining us and we hope you enjoy your experience.')
            ->action('Sign in', route('sign-in'))
            ->line('If you have any questions or need assistance, feel free to contact us.');
    }

    public function toArray(): array
    {
        return [
            //
        ];
    }
}
