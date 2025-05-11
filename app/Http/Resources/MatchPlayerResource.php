<?php

namespace App\Http\Resources;

use App\Models\MatchPlayer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin MatchPlayer */
class MatchPlayerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'role' => $this->role,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'match_id' => $this->match_id,
            'player_id' => $this->player_id,
            'team_id' => $this->team_id,

            'match' => new MatchResource($this->whenLoaded('match')),
            'player' => new PlayerResource($this->whenLoaded('player')),
            'team' => new TeamResource($this->whenLoaded('team')),
        ];
    }
}
