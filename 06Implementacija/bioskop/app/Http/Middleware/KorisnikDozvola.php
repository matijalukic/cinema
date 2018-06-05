<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Ako korisnik nije ulogovan vraca ga
 *
 * Class KorisnikDozvola
 * @package App\Http\Middleware
 */
class KorisnikDozvola
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
        if(! auth('korisnici') -> check())
            return redirect() -> route('dozvola');
        return $next($request);
    }
}
