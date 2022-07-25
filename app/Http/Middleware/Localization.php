<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class Localization
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
        //echo session()->get('lang'); die();
        if (session()->has('lang')) {
            \App::setLocale(session()->get('lang'));
        }
        return $next($request);
    }
}
