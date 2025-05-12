<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BallRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'over_id' => 'required|exists:overs,id',
            'ball_number' => 'required|integer|min:1|max:10',
            'striker_id' => 'required|exists:players,id',
            'non_striker_id' => 'required|exists:players,id',
            'bowler_id' => 'required|exists:players,id',
            'runs_scored' => 'required|integer|min:0',
            'extras' => 'nullable|array',
            'is_wicket' => 'required|boolean',
            'wicket_type' => 'nullable|string|max:50',
            'dismissed_player_id' => 'nullable|exists:players,id',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
