<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OverRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'innings_id' => 'required|exists:innings,id',
            'over_number' => 'required|integer|min:1',
            'bowler_id' => 'required|exists:players,id',
            'total_runs' => 'nullable|integer|min:0',
            'total_wickets' => 'nullable|integer|min:0|max:2',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
