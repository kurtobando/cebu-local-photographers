<?php

namespace App\Services;

use App\Models\User;

class SignInService
{
    public function __construct(
        private readonly User $user
    ) {
        //
    }
}
