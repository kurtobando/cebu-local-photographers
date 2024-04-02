<?php

namespace App\Http\Controllers;

use App\Enums\UserAuthProviderEnum;
use App\Http\Requests\SignUpRequest;
use App\Services\SignUpService;

class SignUpController extends Controller
{
    public function __construct(
        private readonly SignUpService $signUpService
    ) {
        //
    }

    public function index()
    {
        return inertia('TheSignUp');
    }

    public function store(SignUpRequest $request)
    {
        $user = $this->signUpService->signUp($request->all(), UserAuthProviderEnum::DEFAULT->value);

        auth()->loginUsingId($user->id);

        session()->regenerate();

        // TODO! send outbound welcome email

        return redirect()->route('dashboard');
    }
}
