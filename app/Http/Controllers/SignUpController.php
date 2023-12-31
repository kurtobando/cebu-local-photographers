<?php

namespace App\Http\Controllers;

use App\Enums\UserAuthProviderEnum;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SignUpController extends Controller
{
    public function __construct(
        private readonly User $user,
    ) {
        //
    }

    public function index()
    {
        return inertia('TheSignUp');
    }

    public function store(SignUpRequest $request)
    {
        // TODO! create avatar based from user email
        // https://api.multiavatar.com/

        $this->user->name = $request->email;
        $this->user->email = $request->email;
        $this->user->password = Hash::make($request->password);
        $this->user->provider = UserAuthProviderEnum::DEFAULT->value;
        $this->user->save();

        if (!auth()->attempt($request->only('email', 'password'), true)) {
            return redirect()
                ->route('sign-up')
                ->with(['error' => 'Your credentials are invalid! Please try again.']);
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }
}
