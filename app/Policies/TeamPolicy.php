<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        // Allow any authenticated user to view teams
        return true;
    }

    public function view(User $user, Team $team): bool
    {
        // Allow if user is the creator
        return $user->id === $team->created_by;
    }

    public function create(User $user): bool
    {
        // Allow any authenticated user to create a team
        return true;
    }

    public function update(User $user, Team $team): bool
    {
        // Only the creator can update
        return $user->id === $team->created_by;
    }

    public function delete(User $user, Team $team): bool
    {
        // Only the creator can delete
        return $user->id === $team->created_by;
    }

    public function restore(User $user, Team $team): bool
    {
        // Only the creator can restore
        return $user->id === $team->created_by;
    }

    public function forceDelete(User $user, Team $team): bool
    {
        // Only the creator can force delete
        return $user->id === $team->created_by;
    }
}
