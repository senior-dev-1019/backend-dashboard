<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Closure;

class AuthAdmin
{
    /**
     * Display nopermission page if user have no permission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $is_admin = Auth::user()->is_admin;
        if($is_admin != 1){
            Auth::logout();
            Session::flush();
            return redirect('/login')
                ->with('warning', trans('dashboard.no-permission'));
        }
        
        return $next($request);
    }
}
