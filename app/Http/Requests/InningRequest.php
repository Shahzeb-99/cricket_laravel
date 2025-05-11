<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InningRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'match_id' => 'required|exists:matches,id',
            'batting_team_id' => 'required|exists:teams,id',
            'bowling_team_id' => 'required|exists:teams,id|different:batting_team_id',
            'inning_number' => 'required|integer|min:1',
            'is_completed' => 'boolean',
            'total_runs' => 'nullable|integer|min:0',
            'total_wickets' => 'nullable|integer|min:0|max:10',
            'total_overs' => 'nullable|integer|min:0|max:90',
        ];
    }
    public function attributes(): array
    {
        return [
            'match_id' => 'Match ID',
            'batting_team_id' => 'Batting Team ID',
            'bowling_team_id' => 'Bowling Team ID',
            'inning_number' => 'Inning Number',
            'is_completed' => 'Is Completed',
            'total_runs' => 'Total Runs',
            'total_wickets' => 'Total Wickets',
            'total_overs' => 'Total Overs',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
