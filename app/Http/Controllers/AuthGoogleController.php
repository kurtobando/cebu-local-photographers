<?php

namespace App\Http\Controllers;

use App\Enums\UserAuthProviderEnum;
use App\Enums\UserRoleEnum;
use App\Events\UserSignInEvent;
use App\Events\UserSignUpEvent;
use App\Models\User;
use Exception;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class AuthGoogleController extends Controller
{
    public function __construct(
        private readonly User $user
    ) {
        //
    }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $provider = UserAuthProviderEnum::GOOGLE->value;
            $google = Socialite::driver($provider)->user();

            $user = $this
                ->user
                ->where('provider', $provider)
                ->where('email', $google->getEmail());

            if ($user->doesntExist()) {
                $this->user->name = $google->getName();
                $this->user->email = $google->getEmail();
                $this->user->email_verified_at = now();
                $this->user->provider = $provider;
                $this->user->provider_id = $google->getId();
                $this->user->provider_token = $google->token;
                $this->user->provider_refresh_token = $google->refreshToken;
                $this->user->avatar = $google->getAvatar();
                $this->user->save();

                UserSignUpEvent::dispatch($user->first());
            }

            auth()->login($user->first());
            auth()->user()->assignRole(UserRoleEnum::USER->value);

            UserSignInEvent::dispatch($user->first());

            return redirect()->route('dashboard');
        } catch (InvalidStateException|Exception $e) {
            return redirect()->route('sign-in');
        }
    }
}
