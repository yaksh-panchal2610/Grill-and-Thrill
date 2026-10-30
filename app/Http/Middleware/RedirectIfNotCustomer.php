<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfNotCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle($request, Closure $next, $guard = "customer")
    {
        $customerinfo = session()->get('customer');
        if (empty($customerinfo)) {
            return redirect()->route('customer.login.basic');
        }
        // if (!auth()->guard($guard)->check()) {
        //     return redirect(route('customer.login.basic'));
        // }
        return $next($request);
    }
}
