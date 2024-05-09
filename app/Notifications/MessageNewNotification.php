<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MessageNewNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private string $subject;
    private string $message;
    private string $action;

    public function __construct(
        private readonly string $messageUuid
    ) {
        $this->subject = 'You have a new message';
        $this->message = 'Exciting news awaits you! Someone has shown keen interest in your work. Dive into your messages to unveil more.';
        $this->action = route('dashboard.message.show', ['uuid' => $this->messageUuid]);
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
                    ->action('Read Message', $this->action);
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
