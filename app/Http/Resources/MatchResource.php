<?php

namespace App\Http\Resources;

use App\Models\MatchModel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin MatchModel */
class MatchResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'title'      => $this->title,
            'venue'      => $this->venue,
            'match_type' => $this->match_type,
            'overs_limit'=> $this->overs_limit,
            'start_time' => $this->start_time->toDateTimeString(),
            'status'     => $this->status,
            'created_by' => [
                'id'    => $this->creator->id,
                'name'  => $this->creator->full_name ?? $this->creator->username,
                'email' => $this->creator->email,
            ],
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
