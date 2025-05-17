<?php

namespace App\Policies;

use App\Models\Player;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlayerPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    /**
     * Determine whether the user can view the player.
     */
    public function view(User $user, Player $player): bool
    {
        return $user->id === $player->user_id;
    }

    /**
     * Determine whether the user can create a player.
     * Only allow if the user does not already have a player profile.
     */
    public function create(User $user): bool
    {
        return !Player::where('user_id', $user->id)->exists();
    }

    /**
     * Determine whether the user can update the player.
     */
    public function update(User $user, Player $player): bool
    {
        return $user->id === $player->user_id;
    }

    /**
     * Determine whether the user can delete the player.
     */
    public function delete(User $user, Player $player): bool
    {
        return $user->id === $player->user_id;
    }
}
