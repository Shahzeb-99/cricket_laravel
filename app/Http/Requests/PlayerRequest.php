<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayerRequest extends FormRequest
{
    public function authorize(): bool
    {
        // For now, we're allowing all users. Customize as needed.
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|unique:players,email,' . $this->player,  // Unique email per player
            'phone'      => 'nullable|string|max:15',
            'role'       => 'required|string|in:batsman,bowler,all-rounder,wicketkeeper',
            'date_of_birth' => 'required|date|before:today',  // Ensure the date is a past date
            'status'     => 'required|string|in:active,inactive,suspended',
            'team_id'    => 'required|exists:teams,id',  // Ensure the team exists
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'First name is required.',
            'last_name.required'  => 'Last name is required.',
            'email.required'      => 'Email is required.',
            'role.required'       => 'Player role is required.',
            'date_of_birth.required' => 'Date of birth is required.',
            'team_id.required'    => 'Team is required.',
        ];
    }
}
