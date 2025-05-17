<?php

namespace App\Http\Requests\Player;

use Illuminate\Foundation\Http\FormRequest;

class PlayerRequest extends FormRequest
{
    public function authorize(): bool
    {
        // For now, we're allowing all users. Customize as needed.
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'email' => $this->user()->email,
            'user_id' => $this->user()->id,
        ]);
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'phone' => 'nullable|string|max:15',
            'role' => 'required|string|in:batsman,bowler,all-rounder,wicketkeeper',
            'date_of_birth' => 'required|date|before:today',  // Ensure the date is a past date
            'status' => 'required|string|in:active,inactive,suspended',
            'team_id' => 'nullable|exists:teams,id',  // Ensure the team exists
            'email' => 'required|email|unique:players,email',
            'user_id' => 'required|integer|unique:players,user_id',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'email.required' => 'Email is required.',
            'email.unique' => 'This email is already associated with a player profile.',
            'user_id.unique' => 'A player profile already exists for this user.',
            'role.required' => 'Player role is required.',
            'date_of_birth.required' => 'Date of birth is required.',
            'status.required' => 'Status is required.',
        ];
    }
}
