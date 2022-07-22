<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

class MemberAuth
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
        $uri = $request->path();

        setcookie('wanted', $uri, time()+86400, '/');        

        if($request->session()->get('member_logged') != true){
            return redirect()->route('member.login');
        }
        return $next($request);
    }
}
