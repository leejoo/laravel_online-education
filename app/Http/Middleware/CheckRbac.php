<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use Auth;

class CheckRbac
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
		if(Auth::guard('admin')->user()->role_id!=1){
			$router = Route::currentRouteAction();
			

			$role = Auth::guard('admin')->user()->role->auth_ac;
			dd($role);
		
		
		};
        return $next($request);
    }
}
