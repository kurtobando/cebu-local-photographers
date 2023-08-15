<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $fillable = ['title', 'description', 'category_id', 'user_id', 'views', 'likes', 'comments'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
