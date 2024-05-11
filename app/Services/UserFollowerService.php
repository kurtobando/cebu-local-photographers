<?php

namespace App\Services;

use App\Models\UserFollower;

class UserFollowerService
{
    public function __construct(
        private readonly UserFollower $userFollower
    ) {
    }

    public function getFollowerCountByUserId(int $userId): int
    {
        return $this
            ->userFollower
            ->where('user_id', $userId)
            ->count();
    }

    public function saveFollowerUserByUserId(int $userId, int $userIdFollower): UserFollower
    {
        return $this->userFollower->updateOrCreate([
            'user_id' => $userId,
            'user_id_follower' => $userIdFollower,
        ]);
    }

    public function deleteFollowerUserByUserId(int $userId, int $userIdFollower): ?bool
    {
        return $this
            ->userFollower
            ->where(['user_id' => $userId, 'user_id_follower' => $userIdFollower])
            ->delete();
    }

    public function isCurrentUserFollower(int $userId, int|null $userIdFollower): bool
    {
        if (is_null($userIdFollower)) {
            return false;
        }

        return $this
            ->userFollower
            ->where(['user_id' => $userId, 'user_id_follower' => $userIdFollower])
            ->exists();
    }
}
