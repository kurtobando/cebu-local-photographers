<?php

namespace App\Events;

use App\Models\PasswordResetToken;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PasswordResetEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(public PasswordResetToken $passwordResetToken)
    {
        //
    }
}
