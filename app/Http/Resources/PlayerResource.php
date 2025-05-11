<?php

namespace App\Http\Resources;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Player */
class PlayerResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'first_name'  => $this->first_name,
            'last_name'   => $this->last_name,
            'email'       => $this->email,
            'phone'       => $this->phone,
            'role'        => $this->role,
            'date_of_birth' => $this->date_of_birth->toDateString(),  // Format the date properly
            'status'      => $this->status,
            'team'        => [
                'id'    => $this->team->id,
                'name'  => $this->team->name,
            ],
            'created_at'  => $this->created_at->toDateTimeString(),
            'updated_at'  => $this->updated_at->toDateTimeString(),
        ];
    }
}
