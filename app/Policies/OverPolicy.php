<?php

namespace App\Policies;

use App\Models\Over;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OverPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Over $over): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Over $over): bool
    {
    }

    public function delete(User $user, Over $over): bool
    {
    }

    public function restore(User $user, Over $over): bool
    {
    }

    public function forceDelete(User $user, Over $over): bool
    {
    }
}
