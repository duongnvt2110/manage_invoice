<?php

namespace App\Traits;

use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
/**
 * Authenticate User
 */
trait AuthenticatesUsers
{
    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
    */

    public function login(UserLoginRequest $request)
    {
        $credentials = $request->only('user_email', 'user_password');
        if ($token = auth()->attempt($credentials)) {
            if(empty(auth()->user()->first_login)){
                auth()->user()->first_login = now();
            }
            auth()->user()->last_login = now();
            auth()->user()->save();
            return $this->respondWithToken($token);
        }

        if(auth('api')->check()){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return redirect('login');
    }

        /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        if(auth('api')->check()){
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ]);
        }
        return redirect('home')->withCookie('access_token',$token);
    }


    /**
     * Logout and remove cookie
     *
     * @return void
     */
    public function logout(){
        auth()->logout();
        if(auth('api')->check()){
            return response()->json(['message' => 'Successfully logged out']);
        }
        return redirect('/')->withCookie(Cookie::forget('access_token'));
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    public function user(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            return response($user, Response::HTTP_OK);
        }
        return response(null, Response::HTTP_BAD_REQUEST);
    }

}

