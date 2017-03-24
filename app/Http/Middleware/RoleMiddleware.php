<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RoleMiddleware
{
    /**
     * @param $request
     * @param Closure $next
     * @param $role1
     * @param $role2
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handle($request, Closure $next, $role1, $role2 = '', $role3='', $role4='', $role5='')
    {
        if (Auth::guest()) {
            return redirect(route('auth.login'));
        }

        if (!$request->user()->hasRole($role1) && !$request->user()->hasRole($role2) && !$request->user()->hasRole($role3) && !$request->user()->hasRole($role4) && !$request->user()->hasRole($role5)) {
            abort(403);
        }

        return $next($request);
    }
}
