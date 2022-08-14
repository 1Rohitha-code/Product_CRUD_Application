<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CustomerMiddleware
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
        if(Auth::user()->user_type == NULL)
        {
            return $next($request);
        }
       if(Auth::user()->user_type == 'admin')
        {
            return redirect('/warning')->with('status','You are not allowed to access this route.!');
        }
        if(Auth::user()->user_type == 'employee')
        {
            return redirect('/warning')->with('status','You are not allowed to access this route.!');
        }
        

    }
}
