<?php

namespace App\Http\Middleware;

use App\Menadzer;
use App\SalterskiSluzbenik;
use Closure;


/**
 * Proverava da li je salterski sluzbenik ulogovan
 *
 * Class SluzbenikDozvola
 * @package App\Http\Middleware
 */
class SluzbenikDozvola
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
        if(!auth() -> check() || !SalterskiSluzbenik::where('id', auth() -> user() -> id) -> exists())
            return redirect() -> route('dozvola');

        return $next($request);
    }
}
