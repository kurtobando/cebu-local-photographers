<?php

namespace App\Models;

use App\Events\PostLikeEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// TODO! add soft delete
class PostLike extends Model
{
    protected $fillable = [
        'post_id',
        'user_id'
    ];

    protected $dispatchesEvents = [
        'created' => PostLikeEvent::class
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
