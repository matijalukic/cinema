<?php

namespace App\Providers;

use App\Administrator;
use App\Menadzer;
use App\SalterskiSluzbenik;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191); //Solved by increasing StringLength

        /**
         * Blade direktiva za ulogovanog korisnika
         */
        Blade::if('korisnik', function(){
            return Auth::guard('korisnici') -> check();
        });
        /**
         * Blade direktiva proverava da li je zaposleni
         */
        Blade::if('zaposleni', function(){
            return auth() -> check();
        });

        /**
         * Blade direktiva proverava da li je zaposleni ulogovan i da li je administrator
         */
        Blade::if('administrator', function(){
            return auth() -> check() && Administrator::find(auth() -> user() -> id);
        });
        /**
         * Blade direktiva proverava da li je zaposleni ulogovan i da li je menadzer
         */
        Blade::if('menadzer', function(){
            return auth() -> check() && Menadzer::find(auth() -> user() -> id);
        });
        /**
         * Blade direktiva proverava da li je zaposleni ulogovan i da li je sluzbenik
         */
        Blade::if('sluzbenik', function(){
            return auth() -> check() && SalterskiSluzbenik::find(auth() -> user() -> id);
        });
        /**
         * Blade direktiva proverava da li je korisnicik ili zaposelni
         */
        Blade::if('ulogovan', function(){
            return auth()->check() || auth('korisnici') -> check();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
