<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MessageLimit extends Model
{
    public const DEFAULT_LIMIT = 10;

    protected $fillable = [
        'user_id',
        'limit',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
