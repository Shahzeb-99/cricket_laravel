<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MatchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'created_by' => $this->user()->id,
        ]);
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:150',
            'venue' => 'required|string|max:150',
            'match_type' => 'required|string|in:friendly,tournament',
            'overs_limit' => 'required|integer|min:1',
            'start_time' => 'required|date|after:now',
            'status' => 'required|string|in:scheduled,live,completed',
            'created_by' => 'required|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'A match title is required.',
            'venue.required' => 'A venue name is required.',
            'match_type.required' => 'The match type is required.',
            'overs_limit.required' => 'The number of overs limit is required.',
            'start_time.required' => 'Start time is required and must be in the future.',
            'status.required' => 'A match status is required.',
            'created_by.required' => 'The creator is required.',
            'created_by.exists' => 'The creator must be a valid user.',
        ];
    }

    public function validatedData(): array
    {
        return $this->validated();
    }
}
