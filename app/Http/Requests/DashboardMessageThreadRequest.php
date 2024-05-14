<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DashboardMessageThreadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'message' => 'required|string|min:4|max:1000',
            'message_user_id_receiver' => 'required|integer',
            'message_uuid' => 'required|string',
        ];
    }
}
