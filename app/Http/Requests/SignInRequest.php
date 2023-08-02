<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignInRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // TODO! update email validation rules

        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }
}