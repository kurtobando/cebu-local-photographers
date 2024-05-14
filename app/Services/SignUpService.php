<?php

namespace App\Services;

use App\Enums\UserAuthProviderEnum;
use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SignUpService
{
    public function __construct(
        private readonly User $user
    ) {
    }

    public function signUp(array $data, string $provider = ''): User
    {
        if ($provider === UserAuthProviderEnum::GOOGLE->value) {
            return $this->signUpGoogle();
        }

        return $this->signUpDefault($data);
    }

    private function signUpDefault(array $data): User
    {
        $this->user->name = Str::before($data['email'], '@');
        $this->user->email = $data['email'];
        $this->user->password = Hash::make($data['password']);
        $this->user->provider = UserAuthProviderEnum::DEFAULT->value;
        $this->user->assignRole(UserRoleEnum::USER->value);
        $this->user->save();

        return $this->user;
    }

    private function signUpGoogle(): User
    {
        $provider = UserAuthProviderEnum::GOOGLE->value;
        $google = Socialite::driver($provider)->user();

        $user = $this->user->where(['provider' => $provider, 'email' => $google->getEmail()]);

        if ($user->exists()) {
            return $user->first();
        }

        $this->user->name = $google->getName();
        $this->user->email = $google->getEmail();
        $this->user->email_verified_at = now();
        $this->user->provider = $provider;
        $this->user->provider_id = $google->getId();
        $this->user->provider_token = $google->token;
        $this->user->provider_refresh_token = $google->refreshToken;
        $this->user->avatar = $google->getAvatar();
        $this->user->assignRole(UserRoleEnum::USER->value);
        $this->user->save();

        return $this->user;
    }
}
