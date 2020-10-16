<?php

namespace App\Policies;

use App\Customer;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
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

    public function update(User $user, Customer $customer){
        return $user->id = $customer->user_id && $user->hasRole('developer')  ;
    }

    public function delete(User $user, Customer $customer){
        return $user->id = $customer->user_id;
    }

}
