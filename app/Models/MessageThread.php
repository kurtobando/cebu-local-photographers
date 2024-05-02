<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MessageThread extends Model
{
    protected $fillable = [
        'uuid',
        'user_id_sender',
        'user_id_receiver',
        'message',
        'is_read'
    ];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_sender');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_receiver');
    }
}
