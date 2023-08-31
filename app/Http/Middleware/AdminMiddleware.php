<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
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
        /**
         * Check if admin has logged in
         * Admin Panel
         */
        if (!$request->session()->exists('admin_id')) {
            return redirect()->Route('login.view');
        } /**
         * Proceed to next request
         */

        return $next($request);
    }
}
