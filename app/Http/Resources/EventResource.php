<?php

namespace App\Http\Resources;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Event */
class EventResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'event_type' => $this->event_type,
            'details' => $this->details,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'match_id' => $this->match_id,
            'user_id' => $this->user_id,

            'match' => new MatchResource($this->whenLoaded('match')),
        ];
    }
}
