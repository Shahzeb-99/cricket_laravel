<?php

namespace App\Policies;

use App\Models\Ball;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BallPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Ball $ball): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Ball $ball): bool
    {
    }

    public function delete(User $user, Ball $ball): bool
    {
    }

    public function restore(User $user, Ball $ball): bool
    {
    }

    public function forceDelete(User $user, Ball $ball): bool
    {
    }
}
