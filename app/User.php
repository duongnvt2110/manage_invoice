<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable,HasRoles;

    CONST CONFIRMATION = 1;
    CONST ACTIVE = 0;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_password', 'remember_token','user_active_key',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Using for custom email and password column
    /**
     * username
     *
     * @return void
     */
    public function username()
    {
        return 'user_email';
    }

    /**
     * getAttributeCustomPassword
     *
     * @return void
     */
    public function getAttributeCustomPassword()
    {
        return 'user_password';
    }

    /**
     * getAuthPassword
     *
     * @return void
     */
    public function getAuthPassword()
    {
        return $this->user_password;
    }
    // end

    /**
     * getJWTIdentifier
     *
     * @return void
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * getUserByEmail
     *
     * @param  mixed $email
     * @return void
     */
    public function getUserByEmail($email)
    {
        $user = User::where('user_email',$email)->first();
        return $user;
    }

    // public function setUserPasswordAttribute($value){
    //     $this->attributes['user_password'] = bcrypt($value);
    // }
}
