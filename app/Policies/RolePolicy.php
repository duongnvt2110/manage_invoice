<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function viewAny(User $user){
        return $user->hasRole('admin');
    }

    public function create(User $user){
        return $user->hasRole('admin');
    }

    public function update(User $user){
        return $user->hasRole('admin');
    }

    public function delete(User $user){
        return $user->hasRole('admin');
    }
}
