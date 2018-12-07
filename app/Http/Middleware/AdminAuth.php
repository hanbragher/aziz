<?php

namespace Azizner\Http\Middleware;

use Azizner\Admin;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth
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
        $user = Auth::user();
        if (!Admin::where('id', $user->id)->first()) {
            return Abort(404);
        }

        return $next($request);
    }
}
