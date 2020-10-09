<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
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
