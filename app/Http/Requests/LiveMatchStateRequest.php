<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LiveMatchStateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'match_id' => 'required|exists:matches,id',
            'current_innings' => 'nullable|exists:innings,id',
            'striker_id' => 'nullable|exists:players,id',
            'non_striker_id' => 'nullable|exists:players,id',
            'bowler_id' => 'nullable|exists:players,id',
            'current_over' => 'nullable|integer|min:0',
            'current_ball' => 'nullable|integer|min:0|max:10',
            'total_runs' => 'nullable|integer|min:0',
            'total_wickets' => 'nullable|integer|min:0|max:10',
            'overs_completed' => 'nullable|numeric|min:0',
            'last_updated' => 'nullable|date',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
