<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatchPlayerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'match_id' => 'required|exists:matches,id',
            'player_id' => 'required|exists:players,id',
            'team_id' => 'required|exists:teams,id',
            'role' => 'required|in:player,captain,vice_captain',
        ];
    }
}
