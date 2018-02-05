<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Redirect;

use Closure;
use Auth;

class adminMiddleware
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
        if(Auth::user()->admin == 1){
            return $next($request);
        }
        return Redirect::to('mail/1');
    }
}
