<?php

namespace App\Http\Requests\Player;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlayerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name'    => 'sometimes|string|max:100',
            'last_name'     => 'sometimes|string|max:100',
            'phone'         => 'nullable|string|max:15',
            'role'          => 'sometimes|in:batsman,bowler,all-rounder,wicketkeeper',
            'date_of_birth' => 'sometimes|date|before:today',
            'status'        => 'sometimes|in:active,inactive,suspended',
            'team_id'       => 'sometimes|exists:teams,id',
        ];
    }
}
