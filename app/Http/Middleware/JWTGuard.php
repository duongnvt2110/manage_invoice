<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Tymon\JWTAuth\Token;
use App\User;

class JWTGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->cookie('access_token');
        if(empty($token)){
            return redirect('login');
        }

        $token = new Token($token);
        $payload = JWTAuth::decode($token);
        $user = User::find($payload['sub']);
        auth()->login($user);

        return $next($request);
    }
}
