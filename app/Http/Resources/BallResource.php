<?php

namespace App\Http\Resources;

use App\Models\Ball;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Ball */
class BallResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ball_number' => $this->ball_number,
            'runs_scored' => $this->runs_scored,
            'extras' => $this->extras,
            'is_wicket' => $this->is_wicket,
            'wicket_type' => $this->wicket_type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'over_id' => $this->over_id,
            'striker_id' => $this->striker_id,
            'non_striker_id' => $this->non_striker_id,
            'bowler_id' => $this->bowler_id,
            'dismissed_player_id' => $this->dismissed_player_id,

            'over' => new OverResource($this->whenLoaded('over')),
            'striker' => new PlayerResource($this->whenLoaded('striker')),
            'nonStriker' => new PlayerResource($this->whenLoaded('nonStriker')),
            'bowler' => new PlayerResource($this->whenLoaded('bowler')),
            'dismissedPlayer' => new PlayerResource($this->whenLoaded('dismissedPlayer')),
        ];
    }
}
