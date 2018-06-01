<?php

namespace App\Http\Middleware;

use Closure;
use \App\Administrator as Admin;


class AdministratorDozvola
{
    /**
     * Proverava da li je korisnik ulogovan i da li je administrator ako nije redirectujemo ga na dozovola
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(!auth() -> check() || !Admin::where('id', auth() -> user() -> id) -> exists())
            return redirect() -> route('dozvola');

        return $next($request);
    }
}
