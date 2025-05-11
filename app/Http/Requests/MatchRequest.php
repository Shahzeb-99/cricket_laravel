<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Optionally, check if the user is authorized to create or update a match.
        // For now, we're allowing all users, but you can implement your own logic.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title'      => 'required|string|max:150',
            'venue'      => 'required|string|max:150',
            'match_type' => 'required|string|in:friendly,tournament', // Ensure it's one of the valid types
            'overs_limit'=> 'required|integer|min:1',
            'start_time' => 'required|date|after:now', // Match should start after the current time
            'status'     => 'required|string|in:scheduled,live,completed',
            'created_by' => 'required|exists:users,id', // Ensure the user exists in the database
        ];
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required'      => 'A match title is required.',
            'venue.required'      => 'A venue name is required.',
            'match_type.required' => 'The match type is required.',
            'overs_limit.required'=> 'The number of overs limit is required.',
            'start_time.required' => 'Start time is required and must be in the future.',
            'status.required'     => 'A match status is required.',
            'created_by.required' => 'The creator of the match is required.',
        ];
    }

    /**
     * Get the data to be used in the request after validation.
     *
     * @return array<string, mixed>
     */
    public function validatedData(): array
    {
        return $this->validated();
    }
}
