<?php

namespace App\Policies;

use App\Models\Inning;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InningPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Inning $inning): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Inning $inning): bool
    {
    }

    public function delete(User $user, Inning $inning): bool
    {
    }

    public function restore(User $user, Inning $inning): bool
    {
    }

    public function forceDelete(User $user, Inning $inning): bool
    {
    }
}
