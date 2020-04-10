<?php

namespace Chyis\Imperator\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Chyis\Imperator\Models\Menu;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    private $guard = 'admin';

    public function handle($request, Closure $next)
    {
        if (Auth::guard($this->guard)->guest())
        {
            if ($request->ajax() || $request->wantsJson())
            {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('admin/login');
            }
        }
        if (!Request()->ajax() && Request()->isMethod('get'))
        {
//            $userID = $user->id;
            $user = Auth::guard('admin')->user();

            view()->share('loginUser', $user);
            $userID =  $user->id;
            $menuData = Menu::getTypeTree('admin', 'left', $userID);
            view()->share('sideBar', $menuData);
        }

        return $next($request);
    }
}
