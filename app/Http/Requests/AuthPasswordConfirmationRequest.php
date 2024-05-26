<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AuthPasswordConfirmationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'token' => 'required|string|exists:password_reset_tokens,token',
            'password' => ['required', Password::default(), 'confirmed'],
            'password_confirmation' => 'required',
        ];
    }
}
