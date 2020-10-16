<?php

namespace App\Policies;

use App\Analyst;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnalystPolicy
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

    public function create(User $user){
        return isset($user->id);
    }

    public function update(User $user, Analyst $analyst){
        return $user->id = $analyst->user_id && $user->hasRole('developer')  ;
    }

    public function delete(User $user, Analyst $analyst){
        return $user->id = $analyst->user_id;
    }
}
