<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostLikeNotification extends Notification
{
    use Queueable;

    private string $subject;
    private string $message;
    private string $action;

    public function __construct(
        private readonly Post $post,
        private readonly User $user
    ) {
        $this->subject = 'Someone liked your post';
        $this->message = "We're thrilled to inform you that {$this->user->name} liked your post.";
        $this->action = route('post', ['id' => $this->post->id]);
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
            ->action('Visit Post', $this->action)
            ->line("Feel free to visit the post and continue the conversation!");
    }

    public function toArray(object $notifiable): array
    {
        return [
            'subject' => $this->subject,
            'message' => $this->message,
            'action' => $this->action,
        ];
    }
}
