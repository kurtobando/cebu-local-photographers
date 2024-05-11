<?php

namespace App\Listeners;

use App\Events\PostCommentEvent;
use App\Notifications\PostCommentNewNotification;

class PostCommentListener
{
    public function __construct()
    {
    }

    public function handle(PostCommentEvent $event): void
    {
        $event
            ->postComment
            ->post
            ->user
            ->notify(new PostCommentNewNotification($event->postComment));
    }
}
