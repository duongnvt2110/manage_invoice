<?php
namespace App\Repository\User;

use App\Repository\BaseRepository;
use App\Repository\User\UserRepositoryInterface;
use App\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface{

    protected $model;

    public function __construct(User $User)
    {
        $this->model = $User;
    }

}
