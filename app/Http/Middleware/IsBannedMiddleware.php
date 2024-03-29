<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsBannedMiddleware
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
        if(auth()->check() && auth()->user()->is_banned)
        {
            auth()->logout();
            return redirect()->route('login')->with('message', "Twoje konto zostało zablokowane");
        }
        return $next($request);
    }
}
