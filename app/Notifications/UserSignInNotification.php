<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserSignInNotification extends Notification
{
    use Queueable;

    private string $subject;
    private string $message;
    private string $action;

    public function __construct(
        private readonly string $clientIpAddress,
        private readonly string $userAgent
    ) {
        $this->subject = 'We noticed a recent sign-in to your account';
        $this->message = "We noticed a recent sign-in to your account from IP address {$this->clientIpAddress}, using the following user-agent:  {$this->userAgent}.";
        $this->action = '';
    }

    public function via(): array
    {
        return ['mail', 'database'];
    }

    public function toMail(): MailMessage
    {
        return (new MailMessage())
            ->greeting('Greetings!')
            ->subject($this->subject)
            ->line($this->message)
            ->line("If this was you, there's no need to worry. But if you didn't initiate this sign-in, please take immediate action to secure your account, by changing your password.");
    }

    public function toArray(): array
    {
        return [
            'subject' => $this->subject,
            'message' => $this->message,
            'action' => $this->action,
        ];
    }
}
