<?php

namespace App\Events;

use App\Models\PostCommentLike;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostCommentLikeEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(public readonly PostCommentLike $postCommentLike)
    {
        //
    }
}
