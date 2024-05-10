<?php

namespace App\Listeners;

use App\Events\PostCommentLikeEvent;
use App\Models\PostComment;
use App\Notifications\PostCommentLikeNewNotification;

class PostCommentLikeListener
{
    public function __construct(
        private readonly PostComment $postComment
    ) {
        //
    }

    public function handle(PostCommentLikeEvent $event): void
    {
        $postCommentId = $event->postCommentLike->post_comment_id;
        $postComment = $this->postComment->where('id', $postCommentId)->first();
        $post = $event->postCommentLike->post;

        $this
            ->postComment
            ->where('id', $postCommentId)
            ->first()
            ->user()
            ->first()
            ->notify(new PostCommentLikeNewNotification($post, $postComment));
    }
}
