<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserFollowerNewNotification extends Notification
{
    use Queueable;

    private string $subject;
    private string $message;
    private string $action;

    public function __construct(
        private readonly User $user
    ) {
        $this->subject = 'Someone is now following you!';
        $this->message = "Exciting news! We're delighted to let you know that {$this->user->name} has started following you.";
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
            ->line($this->message);
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
