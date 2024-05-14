<?php

namespace App\Notifications;

use App\Models\PostComment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostCommentNewNotification extends Notification
{
    use Queueable;

    private string $subject;
    private string $message;
    private string $action;

    public function __construct(
        private readonly PostComment $postComment
    ) {
        $this->subject = 'Your post has received a comment';
        $this->message = "We're thrilled to inform you that someone has left a comment on your post.";
        $this->action = route('post', ['id' => $this->postComment->post_id]);
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
            ->line($this->postComment->comment)
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
