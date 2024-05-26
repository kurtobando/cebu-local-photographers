<?php

namespace App\Http\Controllers\Public\Auth;

use App\Enums\UserAuthProviderEnum;
use App\Events\UserSignInEvent;
use App\Http\Controllers\Controller;
use App\Services\SignUpService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthSignUpGoogleController extends Controller
{
    public function __construct(
        private readonly SignUpService $signUpService,
    ) {
    }

    public function redirect(): RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request): RedirectResponse
    {
        $user = $this->signUpService->signUp([], UserAuthProviderEnum::GOOGLE->value);

        auth()->loginUsingId($user->id);

        event(new UserSignInEvent(
            auth()->user(),
            $request->getClientIp(),
            $request->header('User-Agent')
        ));

        session()->regenerate();

        return redirect()->route('dashboard');
    }
}
