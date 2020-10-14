<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Controllers\Controller;
use App\Mail\EmailRegister;
use App\User;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(UserRegisterRequest $request)
    {
        $registerFrom = $request->only(['user_name','user_email','user_password']);

        $user = User::create([
            'user_name' => $registerFrom['user_name'],
            'user_email' => $registerFrom['user_email'],
            'user_password' => bcrypt($registerFrom['user_password']),
            'user_status' => User::CONFIRMATION,
            'user_active_key' => Str::limit(md5($registerFrom['user_email'].Str::random()),25,''),
            'first_login' => null,
            'last_login' => null,
            'active_email_at' => null,
            'remember_token' => Str::random(10),
        ]);

        if(app()->environment() == 'local'){
            Mail::to('meocom10@gmail.com')->send(new EmailRegister($user->user_active_key));
        }else{
            Mail::to($registerFrom['user_email'])->send(new EmailRegister($user->user_active_key));
        }

        return redirect('/login');
    }

    public function confirm(Request $request){

        $confirmForm = $request->only('token');
        User::where('user_active_key',$confirmForm['token'])
        ->update([
            'user_status'=> User::ACTIVE,
            'user_active_key'=> null
        ]);

        return redirect('login');
    }

}
