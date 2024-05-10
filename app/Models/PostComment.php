<?php

namespace App\Models;

use App\Events\PostCommentEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PostComment extends Model
{
    protected $fillable = ['post_id', 'user_id', 'comment', 'status', 'views', 'likes'];


    protected $dispatchesEvents = [
        'created' => PostCommentEvent::class
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function commentLike(): HasMany
    {
        return $this->hasMany(PostCommentLike::class);
    }
}
