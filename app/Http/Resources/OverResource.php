<?php

namespace App\Http\Resources;

use App\Models\Over;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Over */
class OverResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'total_runs' => $this->total_runs,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'inning_id' => $this->inning_id,

            'inning' => new InningResource($this->whenLoaded('inning')),
            'bowler' => new PlayerResource($this->whenLoaded('bowler')),
        ];
    }
}
