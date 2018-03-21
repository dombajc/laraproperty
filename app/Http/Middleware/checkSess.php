<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class checkSess
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
        if ( !$request->session()->exists('idu') )  {
            return redirect('/log-in');
        }
        
        return $next($request);
    }
}
