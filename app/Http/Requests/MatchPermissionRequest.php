<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatchPermissionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'match_id' => 'required|exists:matches,id',  // Ensure the match exists
            'user_id' => 'required|exists:users,id',    // Ensure the user exists
            'role' => 'required|string|max:50',          // Role should be a string with a max length of 50
            'can_edit' => 'required|boolean',            // Permission to edit
            'can_delete' => 'required|boolean',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
