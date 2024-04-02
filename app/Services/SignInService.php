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

    public function signIn(string $email, string $password, bool $remember = false): bool
    {
        if (!$this->isActive($email)) {
            // TODO! throw exception here
            return false;
        }

        return auth()->attempt([
            'email' => $email,
            'password' => $password
        ], $remember);
    }

    private function isActive(string $email): bool
    {
        return $this
            ->user
            ->where(['email' => $email, 'is_active' => true])
            ->exists();
    }
}
