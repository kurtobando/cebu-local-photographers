<?php

namespace App\Http\Controllers;

use App\Enums\UserAuthProviderEnum;
use App\Services\SignUpService;
use Laravel\Socialite\Facades\Socialite;

class SignUpGoogleController extends Controller
{
    public function __construct(
        private readonly SignUpService $signUpService,
    ) {
        //
    }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $user = $this->signUpService->signUp([], UserAuthProviderEnum::GOOGLE->value);

        auth()->loginUsingId($user->id);

        session()->regenerate();

        // TODO! send outbound welcome email

        return redirect()->route('dashboard');
    }
}
