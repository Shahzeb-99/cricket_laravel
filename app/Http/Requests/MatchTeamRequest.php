<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatchTeamRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Customize as per authorization logic if needed
    }

    public function rules(): array
    {
        return [
            'match_id'  => 'required|exists:matches,id',   // Ensure the match exists
            'team_id'   => 'required|exists:teams,id',    // Ensure the team exists
            'team_role' => 'required|in:team_a,team_b',    // Ensure the role is either 'team_a' or 'team_b'
        ];
    }

    public function messages(): array
    {
        return [
            'match_id.required'  => 'The match ID is required.',
            'team_id.required'   => 'The team ID is required.',
            'team_role.required' => 'The team role is required.',
        ];
    }
}
