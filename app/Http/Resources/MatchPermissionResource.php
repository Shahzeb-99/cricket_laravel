<?php

namespace App\Http\Resources;

use App\Models\MatchPermission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin MatchPermission */
class MatchPermissionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'role' => $this->role,
            'can_edit' => $this->can_edit,
            'can_delete' => $this->can_delete,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'match_id' => $this->match_id,
            'user_id' => $this->user_id,

            'match' => new MatchResource($this->whenLoaded('match')),
        ];
    }
}
