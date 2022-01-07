<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() && (Auth::user()->status == 'INACTIVO')){

            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route('login')->with('error','** Tu cuenta esta suspendida, por favor contacta al administrador. **');
        }

        return $next($request);



        /*if(Auth::user()->status == 'INACTIVO') {

            return Log::error('Usuario inactivo');
        }

        
        if(Auth::user()->status == 'INACTIVO') {

            Auth::logout();
            return route('login')->withErrors('Your account is inactive');
        } */
    }
}
