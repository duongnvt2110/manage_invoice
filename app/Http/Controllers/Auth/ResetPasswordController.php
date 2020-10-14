<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\User;
use Carbon\Carbon;

class ResetPasswordController extends Controller
{
    //
    public function showResetPasswordForm(){
        return view('auth.passwords.email');
    }

    public function showConfirmationForm(){
        return view('auth.passwords.reset');
    }

    public function reset(Request $request){
        $resetForm = $request->validate([
            'user_email'=> 'required|exists:users,user_email'
        ]);
        $token = Str::limit(md5($resetForm['user_email'].Str::random()),25, '');
        $user = User::where('user_email',$resetForm['user_email'])->first();
        $now = Carbon::now();
        DB::insert('insert into password_resets (user_id,user_email,token,status,created_at) value (?,?,?,?,?)',[$user->id,$resetForm['user_email'],$token,1,$now]);
        Mail::to('meocom10@gmail.com')->send(new ResetPassword($token,$resetForm['user_email']));
        return redirect('login')->with('success','Please check your email');
    }

    public function confirm(Request $request){
        $confirmForm = $request->only(['token','user_email','user_password','password_confirmation']);
        $reset_user = DB::update('UPDATE password_resets SET `status` = 0,`token` = null where token = ? and status = 1',[$confirmForm['token']]);
        if($reset_user){
            User::where('user_email',$confirmForm['user_email'])
            ->update([
                'user_password'=> bcrypt($confirmForm['user_password']),
            ]);
        }
        return redirect('login')->with('success','Update check your email');
    }
}
