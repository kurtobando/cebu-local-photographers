<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Collection;

class UserService
{
    public function __construct(
        private readonly User $user
    ) {
        //
    }

    public function getUsers(): Collection
    {
        return $this
        ->user
        ->where('is_active', true)
        ->whereNotNull('avatar')
        ->get();
    }

    public function getUserById(int $id): User
    {
        return $this
            ->user
            ->findOrFail($id);
    }

    public function isUserActive(int $id): bool
    {
        return $this
            ->user
            ->where('id', $id)
            ->where('is_active', true)
            ->exists();
    }
}
