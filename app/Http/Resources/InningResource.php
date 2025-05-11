<?php

namespace App\Http\Resources;

use App\Models\Inning;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Inning */
class InningResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'inning_number' => $this->inning_number,
            'is_completed' => $this->is_completed,
            'total_runs' => $this->total_runs,
            'total_wickets' => $this->total_wickets,
            'total_overs' => $this->total_overs,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'match_id' => $this->match_id,
            'batting_team_id' => $this->batting_team_id,

            'match' => new MatchResource($this->whenLoaded('match')),
            'battingTeam' => new TeamResource($this->whenLoaded('battingTeam')),
            'bowlingTeam' => new TeamResource($this->whenLoaded('bowlingTeam')),
        ];
    }
}
