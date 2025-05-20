<?php

namespace App\Policies;

use App\Models\MatchModel;
use App\Models\MatchPlayer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MatchPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, MatchModel $match): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, MatchModel $match): bool
    {
    }

    public function delete(User $user, MatchModel $match): bool
    {
    }

    public function restore(User $user, MatchModel $match): bool
    {
    }

    public function forceDelete(User $user, MatchModel $match): bool
    {
    }

    public function assignTeam(User $user, MatchPlayer $matchPlayer): bool
    {
        $match = $matchPlayer->match;

        return $user->id === $match->created_by || $user->id === $matchPlayer->player()->user_id;
    }
}
