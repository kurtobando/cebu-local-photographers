<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostCommentLikeNewNotification extends Notification
{
    use Queueable;

    private string $subject;
    private string $message;
    private string $action;

    public function __construct(
        private readonly Post $post,
        private readonly PostComment $postComment
    ) {
        $this->subject = 'Someone liked your comment';
        $this->message = "We're excited to inform you that someone appreciated your comment on one of our posts.";
        $this->action = route('post', ['id' => $this->post->id]);
    }

    public function via(): array
    {
        return ['mail', 'database'];
    }

    public function toMail(): MailMessage
    {
        // TODO! format the comment text copy, using markdown templates
        return (new MailMessage())
            ->greeting('Greetings!')
            ->subject($this->subject)
            ->line($this->message)
            ->line("{$this->postComment->comment}")
            ->action('Visit Post', $this->action)
            ->line('Feel free to visit the post and continue the conversation!');
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
