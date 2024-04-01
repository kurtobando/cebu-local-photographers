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
            'is_change_password' => 'required|boolean',
            'password' => ['exclude_if:is_change_password,false', Password::defaults(), 'confirmed'],
            'password_confirmation' => 'exclude_if:is_change_password,false',
        ];
    }
}
