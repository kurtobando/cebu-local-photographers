<?php

namespace App\Http\Controllers;

use App\Enums\UserAuthProviderEnum;
use App\Http\Requests\SignUpRequest;
use App\Services\SignUpService;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class SignUpController extends Controller
{
    public function __construct(
        private readonly SignUpService $signUpService
    ) {
    }

    public function index(): Response
    {
        return inertia('TheSignUp');
    }

    public function store(SignUpRequest $request): RedirectResponse
    {
        $user = $this->signUpService->signUp($request->all(), UserAuthProviderEnum::DEFAULT->value);

        auth()->loginUsingId($user->id);

        session()->regenerate();

        return redirect()->route('dashboard');
    }
}
