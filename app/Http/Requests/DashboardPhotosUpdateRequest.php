<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DashboardPhotosUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:posts,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'post_category_id' => 'required|integer',
            'tags' => 'required|array',
        ];
    }
}
