<?php

namespace App\Http\Requests;

use App\Enums\UserAuthProviderEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class DashboardProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'about' => 'required|string|max:500',
            'provider' => 'required|in:' . implode(',', UserAuthProviderEnum::toArray()),
            'password' => ['exclude_if:provider,' . UserAuthProviderEnum::GOOGLE->value, Password::defaults(), 'confirmed'],
            'password_confirmation' => 'exclude_if:provider,' . UserAuthProviderEnum::GOOGLE->value
        ];
    }
}
