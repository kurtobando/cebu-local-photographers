<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// TODO! add soft delete
class PostLike extends Model
{
    protected $fillable = ['post_id', 'user_id'];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
