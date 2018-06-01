<?php

namespace App\Http\Middleware;

use App\Menadzer;
use Closure;

/**
 * Proverava da li je ulogovani zaposleni menadzer
 *
 * Class MenadzerDozvola
 * @package App\Http\Middleware
 */
class MenadzerDozvola
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
        if(!auth() -> check() || !Menadzer::where('id', auth() -> user() -> id) -> exists())
            return redirect() -> route('dozvola');

        return $next($request);
    }
}
