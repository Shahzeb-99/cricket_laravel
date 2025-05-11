<?php

namespace App\Http\Resources;

use App\Models\MatchTeam;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin MatchTeam */
class MatchTeamResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'team_role' => $this->team_role,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),

            'match_id' => $this->match_id,
            'team_id' => $this->team_id,

            'match' => new MatchResource($this->whenLoaded('match')),
            'team' => new TeamResource($this->whenLoaded('team')),
        ];
    }
}
