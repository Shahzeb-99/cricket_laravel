<?php

namespace App\Policies;

use App\Models\LiveMatchState;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LiveMatchStatePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, LiveMatchState $liveMatchState): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, LiveMatchState $liveMatchState): bool
    {
    }

    public function delete(User $user, LiveMatchState $liveMatchState): bool
    {
    }

    public function restore(User $user, LiveMatchState $liveMatchState): bool
    {
    }

    public function forceDelete(User $user, LiveMatchState $liveMatchState): bool
    {
    }
}
