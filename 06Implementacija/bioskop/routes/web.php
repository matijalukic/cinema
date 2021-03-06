<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Home routes
Route::get('/', 'HomeController@index') -> name('home');
Route::get('filmovi', 'HomeController@filmovi') -> name('filmovi'); // svi filmovi + pretraga
Route::get('film/{film}', 'HomeController@film') -> name('film'); // svi detalji jednog filma  + projekcije
Route::get('bioskop/{bioskop}', 'HomeController@bioskop') -> name('bioskop'); // svi detalji jednog bioskopa + projekcije
Route::get('projekcije', 'HomeController@projekcije') -> name('projekcije'); // pretraga projekcija


// Ruta ako je korisnik prekoracio dozvolu
Route::get('/nema/dozvolu',    'HomeController@nemaDozvolu') -> name('dozvola');


/**
 * Rute samo za goste
 */
Route::get('registracija', 'GostController@registracija') ->name('registracija');
Route::post('registracija', 'GostController@registracijaPost')->name('registracija.post');
Route::get('login',  'GostController@loginKorisnik') -> name("korisnik.login");
Route::post('login/korisnik',  'GostController@korisnikLogin') -> name("korisnik.login.post");

/**
 * Rute ulogovanih korisnika
 */
Route::get('logout',  'KorisnikController@logout') -> name("korisnik.logout");
Route::get('rezervacija/{projekcija?}', 'KorisnikController@rezervacija')->name('rezervacija');
Route::post('rezervacija', 'KorisnikController@rezervacijaPost')->name('rezervacija.post');
Route::get('rezervacija/obrisi/{rezervacija}', 'KorisnikController@obrisiRezervaciju')->name('rezervacija.brisi');


/**
 * Rute zaposlenih
 */
Route::get('zaposeln', 'ZaposleniController@index') -> name('zaposleni.index');
Route::get('login/zaposleni',  'ZaposleniController@loginZaposleni') -> name("zaposleni.login");
Route::post('login/zaposleni',  'ZaposleniController@zaposleniLogin') -> name("zaposleni.login.post");
Route::get('logout/zaposleni',  'ZaposleniController@logout') -> name("zaposleni.logout");


/**
 * Administratorske rute
 */
Route::prefix('admin') -> group(function(){

    Route::get('film/dodaj', 'AdministratorController@dodavanjeFilma') -> name('administrator.film.dodavanje');
    Route::post('filmovi/dodaj', 'AdministratorController@unosFilma') -> name('administrator.film.unos');

    Route::get('bioskop/dodaj', 'AdministratorController@dodavanjeBioskopa') -> name('administrator.bioskop.dodavanje');
    Route::post('bioskopi/dodaj', 'AdministratorController@unosBioskopa') -> name('administrator.bioskop.unos');

    Route::get('bioskopi',  'AdministratorController@bioskopi') -> name('administrator.bioskopi');
    Route::get('bioskop/obrisi/{id}',   'AdministratorController@obrisiBioskop') -> name('administrator.bioskop.obrisi');

    Route::get('film/izmeni/{id}', 'AdministratorController@izmenaFilma') -> name('administrator.film.izmena');
    Route::post('film/izmeni', 'AdministratorController@izmenaFilmaPost') -> name('administrator.film.izmena.post');

    Route::get('zaposleni/brisi', 'AdministratorController@brisiNalog') ->name('administrator.zaposleni.brisi');
    Route::post('zaposleni/brisi', 'AdministratorController@brisiNalogPost') ->name('administrator.zaposleni.brisi.post');

    Route::get('zaposleni/brisisve', 'AdministratorController@brisiSve') ->name('administrator.zaposleni.brisisve');
    Route::post('zaposleni/brisisve', 'AdministratorController@brisiSvePost') ->name('administrator.zaposleni.brisisve.post');

    Route::get('kreirajnalog', 'AdministratorController@kreirajNalog') ->name('administrator.kreirajnalog');
    Route::post('kreirajnalog', 'AdministratorController@kreirajNalogPost') ->name('administrator.kreirajnalog.post');

    Route::get('zaposleni/filmovi', 'AdministratorController@filmovi') ->name('administrator.zaposleni.filmovi');
    Route::get('zaposleni/filmovi/obrisi/{id}', 'AdministratorController@obrisiFilm') ->name('administrator.zaposleni.filmovi.obrisi');
});

/**
 * Menadzerske rute
 */
Route::prefix('menadzer') -> group(function(){
    Route::get('projekcija/dodaj',  'MenadzerController@dodajProjekciju') -> name('menadzer.projekcija.dodavanje');
    Route::post('projekcija/dodaj',  'MenadzerController@dodajProjekcijuPost') -> name('menadzer.projekcija.dodavanje.post');
    Route::get('projekcije/menadzer' ,   'MenadzerController@projekcije') -> name('menadzer.projekcije');
    Route::get('projekcija/obrisi/{id}' ,   'MenadzerController@obrisiProjekciju') -> name('menadzer.projekcija.obrisi');
});
/**
 * Rute salterskog sluzbenika
 */
Route::prefix('sluzbenik') -> group(function() {
    Route::get('zaposleni/karta/prodaja', 'SluzbenikController@prodateKarte')->name('karte');

    Route::post('zaposleni/karta/prodaja', 'SluzbenikController@prodateKartePost')->name('karte.post');
    Route::get('rezervacija/karta/prodaja', 'SluzbenikController@rezervacijaKarte')->name('karte.rezervacija.post');

});