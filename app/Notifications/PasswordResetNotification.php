<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordResetNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly string $token,
        private readonly string $email
    ) {
        //
    }

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail(): MailMessage
    {
        return (new MailMessage())
            ->subject('Your Password Reset')
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->line('If you wish to continue with the password reset, please click the button below.')
            ->action('Password Reset', route('password-confirmation', ['token' => $this->token, 'email' => $this->email]))
            ->line('If you have any questions or need assistance, feel free to contact us.');
    }

    public function toArray(): array
    {
        return [
            //
        ];
    }
}
