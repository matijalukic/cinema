<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Korisnik mora biti gost da bi realizovao operaciju
 *
 * Class GostDozovola
 * @package App\Http\Middleware
 */
class GostDozovola
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
        if(auth() -> check() || auth('korisnici') -> check())
            return redirect() -> route("dozvola");

        return $next($request);
    }
}
