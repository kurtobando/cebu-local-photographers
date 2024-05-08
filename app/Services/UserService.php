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

    public function getUsersInRandomOrder(): Collection
    {
        return $this
            ->user
            ->where('is_active', true)
            ->whereNotNull('avatar')
            ->inRandomOrder()
            ->get();
    }

    public function getUserById(int $id): User
    {
        return $this
            ->user
            ->findOrFail($id);
    }

    public function isUserActive(int $userId): bool
    {
        return $this
            ->user
            ->where('id', $userId)
            ->where('is_active', true)
            ->exists();
    }
}
