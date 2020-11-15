<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\AuthenticatesUsers;

class AuthController extends Controller
{
    use AuthenticatesUsers;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.guard', ['except' => ['login','showLoginForm']]);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

}
