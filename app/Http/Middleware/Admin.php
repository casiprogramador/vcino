<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class Admin
{


    public function handle($request, Closure $next)
    {
		//dd($request->user());
		return Auth::onceBasic() ?: $next($request);
    }
}
