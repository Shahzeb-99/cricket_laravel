<?php

namespace App\Http\Resources;

use App\Models\LiveMatchState;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin LiveMatchState */
class LiveMatchStateResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'match_id' => $this->match_id,
            'current_innings' => $this->current_innings,
            'striker' => optional($this->striker)->only(['id', 'name']),
            'non_striker' => optional($this->nonStriker)->only(['id', 'name']),
            'bowler' => optional($this->bowler)->only(['id', 'name']),
            'current_over' => $this->current_over,
            'current_ball' => $this->current_ball,
            'total_runs' => $this->total_runs,
            'total_wickets' => $this->total_wickets,
            'overs_completed' => $this->overs_completed,
            'last_updated' => $this->last_updated,
        ];
    }
}
