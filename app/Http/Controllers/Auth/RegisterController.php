<?php

namespace App\Http\Controllers\Auth;

use App\Events\SendMail;
use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Controllers\Controller;
use App\Services\Utils;
use App\User;

class RegisterController extends Controller
{
    protected $utils;

    public function __construct()
    {
        $this->utils = new Utils();
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(UserRegisterRequest $request)
    {
        $registerForm = $request->only(['user_name','user_email','user_password']);
        $user = User::create(array_merge($registerForm,$this->utils->getDefaultUserForm($registerForm)));
        event(new SendMail($user,$registerForm));
        return redirect('/login')->with('success','Register is Success');
    }

    public function confirm(Request $request){

        $confirmForm = $request->only('token');
        $user = User::where('user_active_key',$confirmForm['token'])->first();
        if($user){
            $user->update([
                'user_status'=> User::ACTIVE,
                'user_active_key'=> null
            ]);
            return redirect('login')->with('success','Active is success');
        }
        return redirect('login')->with('success','Token was actived');
    }

}
