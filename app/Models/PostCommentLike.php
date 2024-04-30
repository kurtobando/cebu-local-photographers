<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostCommentLike extends Model
{
    protected $fillable = ['user_id', 'post_id', 'post_comment_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function comment(): BelongsTo
    {
        return $this->belongsTo(PostComment::class);
    }
}