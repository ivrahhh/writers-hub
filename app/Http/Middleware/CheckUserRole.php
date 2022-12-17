<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        $userRole = $request->user()->role;

        $roles = !empty($roles) 
            ? array_map(fn($value) => ucfirst($value), $roles) 
            : [null];
        /**
         * Check the user role if it is not equals to the given role.
         * If the user role is not equals to the given role continue to the condition otherwise ignore it.
         */
        if(! in_array($userRole, $roles)) {
            /**
             * If the user role is equals to Admin redirect to the admin dashboard
             */
            if($userRole === 'Admin') {
                return redirect()->route('dashboard');

            }

            /**
             * If the user role is inside the array, redirect to the given route
             */
            if(in_array($userRole, ['Author','Member'])) {
                return abort(403);
            }
        }

        return $next($request);
    }
}
