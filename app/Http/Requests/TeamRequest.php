<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
{
    public function authorize(): bool
    {
        // You can customize authorization logic here
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Team name is required.',
            'name.string' => 'Team name must be a string.',
            'name.max' => 'Team name must not exceed 100 characters.',
        ];
    }
}
