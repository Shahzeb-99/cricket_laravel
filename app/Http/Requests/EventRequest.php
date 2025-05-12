<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'match_id' => 'required|exists:matches,id',  // Ensure match exists in the database
            'user_id' => 'required|exists:users,id',    // Ensure user exists in the database
            'event_type' => 'required|string|max:50',   // Type of event
            'details' => 'required|json',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
