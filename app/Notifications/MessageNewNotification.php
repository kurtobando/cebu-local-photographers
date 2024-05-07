<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MessageNewNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly string $messageUuid
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
                    ->greeting('Greetings!')
                    ->subject('You have a new message')
                    ->line('Exciting news awaits you! Someone has shown keen interest in your work. Dive into your messages to unveil more.')
                    ->action('Read Message', route('dashboard.message.show', ['uuid' => $this->messageUuid]));
    }

    public function toArray(): array
    {
        return [
            //
        ];
    }
}
