<?php

namespace App\Policies;

use App\Models\MatchTeam;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MatchTeamPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, MatchTeam $matchTeam): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, MatchTeam $matchTeam): bool
    {
    }

    public function delete(User $user, MatchTeam $matchTeam): bool
    {
    }

    public function restore(User $user, MatchTeam $matchTeam): bool
    {
    }

    public function forceDelete(User $user, MatchTeam $matchTeam): bool
    {
    }
}
