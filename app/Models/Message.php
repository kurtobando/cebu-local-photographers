<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $fillable = [
        'uuid',
        'subject',
        'user_id',
        'is_archived',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
