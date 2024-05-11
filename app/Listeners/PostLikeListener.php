<?php

namespace App\Listeners;

use App\Events\PostLikeEvent;
use App\Notifications\PostLikeNotification;

class PostLikeListener
{
    public function __construct()
    {
    }

    public function handle(PostLikeEvent $event): void
    {
        if ($event->postLike->user->id === $event->postLike->post->user_id) {
            return;
        }

        $event
            ->postLike
            ->post
            ->user
            ->notify(new PostLikeNotification(
                $event->postLike->post,
                $event->postLike->user
            ));
    }
}
