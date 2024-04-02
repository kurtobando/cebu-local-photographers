<?php

namespace App\Http\Controllers;

use App\Enums\UserAuthProviderEnum;
use App\Services\SignUpService;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class SignUpGoogleController extends Controller
{
    public function __construct(
        private readonly SignUpService $signUpService,
    ) {
        //
    }

    public function redirect(): RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(): RedirectResponse
    {
        $user = $this->signUpService->signUp([], UserAuthProviderEnum::GOOGLE->value);

        auth()->loginUsingId($user->id);

        session()->regenerate();

        return redirect()->route('dashboard');
    }
}
