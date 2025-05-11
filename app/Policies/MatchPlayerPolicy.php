<?php

namespace App\Policies;

use App\Models\MatchPlayer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MatchPlayerPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, MatchPlayer $matchPlayer): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, MatchPlayer $matchPlayer): bool
    {
    }

    public function delete(User $user, MatchPlayer $matchPlayer): bool
    {
    }

    public function restore(User $user, MatchPlayer $matchPlayer): bool
    {
    }

    public function forceDelete(User $user, MatchPlayer $matchPlayer): bool
    {
    }
}
