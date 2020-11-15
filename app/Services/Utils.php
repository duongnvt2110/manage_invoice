<?php

namespace App\Services;

use App\User;
use Illuminate\Support\Str;
use App\Mail\EmailRegister;


class Utils {

    public function __construct()
    {

    }

    public function getDefaultUserForm($registerFrom){
        return [
            'user_password'=> bcrypt($registerFrom['user_password']),
            'user_status' => User::CONFIRMATION,
            'user_active_key' => Str::limit(md5($registerFrom['user_email'].Str::random()),25,''),
            'first_login' => null,
            'last_login' => null,
            'active_email_at' => null,
            'remember_token' => Str::random(10)
        ];
    }
}
