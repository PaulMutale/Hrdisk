<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class paymentsExpired
{

    
	
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $msg = "Whoops, subscription expired <a style='color:white; font-style:italic' target='_blank' href='https://www.elianaconnect.com/register'> click me  </a>  to subscribe";
        Auth::guard()->logout();
		return redirect()->route('login')->withErrors($msg);
    }
}
