<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserSignUpEvent
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(
        public User $user
    ) {
    }
}
