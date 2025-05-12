<?php

namespace App\Policies;

use App\Models\MatchPermission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MatchPermissionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, MatchPermission $matchPermission): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, MatchPermission $matchPermission): bool
    {
    }

    public function delete(User $user, MatchPermission $matchPermission): bool
    {
    }

    public function restore(User $user, MatchPermission $matchPermission): bool
    {
    }

    public function forceDelete(User $user, MatchPermission $matchPermission): bool
    {
    }
}
