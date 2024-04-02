<?php

namespace App\Http\Controllers;

use App\Enums\UserAuthProviderEnum;
use App\Enums\UserRoleEnum;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class AuthGoogleController extends Controller
{
    public function __construct(
        private readonly User $user,
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
                $this->user->assignRole(UserRoleEnum::USER->value);
                $this->user->save();
            }

            auth()->login($user->first());

            return redirect()->route('dashboard');
        } catch (InvalidStateException|Exception $e) {
            // TODO! find a better way to implement this catch
            Log::error($e->getMessage());

            return redirect()
                ->route('sign-in')
                ->withErrors($e->getMessage());
        }
    }
}
