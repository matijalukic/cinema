<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Prolazi proveru da li je zaposleni ulogovan
 *
 * Class ZaposelniDozvola
 * @package App\Http\Middleware
 */
class ZaposelniDozvola
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
        if(!auth() -> check())
            return redirect() -> route('dozvola');
        return $next($request);
    }
}
