<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        // return $next($request);
        if(Auth::user()->user_type == 'admin')
        {
            return $next($request);
        }
       if(Auth::user()->user_type == NULL)
        {
            return redirect('/warning')->with('status','You are not allowed to access this route.!');
        }
        if(Auth::user()->user_type == 'employee')
        {
            return redirect('/warning')->with('status','You are not allowed to access this route.!');
        }
        
    }
}
