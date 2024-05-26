<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class UserService
{
    public function __construct(
        private readonly User $user
    ) {
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

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function updateProfileImageByUserId(int $userId, UploadedFile $file): void
    {
        $user = $this->user->findOrFail($userId);
        $user->avatar = $user->addMedia($file)->toMediaCollection('avatar')->getFullUrl('thumbnail');
        $user->save();
    }

    public function updateProfileByUserId(int $id, array $data): void
    {
        $user = $this->user->findOrFail($id);
        $user->name = $data['name'];
        $user->about = $data['about'];
        $user->save();
    }

    public function updatePasswordByUserId(int $id, string $password): void
    {
        $user = $this->user->findOrFail($id);
        $user->password = Hash::make($password);
        $user->save();
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
