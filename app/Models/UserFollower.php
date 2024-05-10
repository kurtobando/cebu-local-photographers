<?php

namespace App\Models;

use App\Events\UserFollowerEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// TODO! add soft delete
class UserFollower extends Model
{
    protected $fillable = [
        'user_id',
        'user_id_follower',
    ];

    protected $dispatchesEvents = [
        'created' => UserFollowerEvent::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function userFollower(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_follower');
    }
}
