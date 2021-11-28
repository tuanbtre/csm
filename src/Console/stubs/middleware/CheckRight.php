<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRight
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = \Auth::guard('admin')->user();
		if(!$user)
			return redirect()->route('admin.login');
		elseif($user->isadmin || $user->hasAccess(\Route::currentRouteName()))
			return $next($request);
		else
			return redirect()->route('admin.home')->with(['Flass_Message'=>'Bạn không có quyền truy xuất chức năng này']);
    }
}
