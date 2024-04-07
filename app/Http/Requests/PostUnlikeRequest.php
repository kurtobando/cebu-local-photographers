<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUnlikeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'post_id' => 'required|exists:posts,id',
        ];
    }
}
