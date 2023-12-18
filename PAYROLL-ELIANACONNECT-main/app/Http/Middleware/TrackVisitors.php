<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Location;
use App\TrackUsers as CaptureUsers;
class TrackVisitors
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
       /* Capture users IP Adress
            */
      if ($position = Location::get(request()->ip())) {
			// Successfully retrieved position.
			
		CaptureUsers::create([
            'countryName' => $position->countryName,
			'countryCode' => $position->countryCode,  
			'regionCode' => $position->regionCode,
            'regionName' => $position->regionName,
            'latitude' => $position->latitude, 
			'longitude' => $position->longitude,
            'ip' => $position->ip  
		]);
       

        return $next($request);
    }
    }
}
