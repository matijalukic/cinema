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


// Rute za korisnika

Route::get('registracija', 'KorisnikController@registracija') ->name('registracija');
Route::post('registracija', 'KorisnikController@registracijaPost')->name('registracija.post');
Route::get('login',  'KorisnikController@loginKorisnik') -> name("korisnik.login");
Route::post('login/korisnik',  'KorisnikController@korisnikLogin') -> name("korisnik.login.post");
Route::get('logout',  'KorisnikController@logout') -> name("korisnik.logout");

/**
 * Rute zaposlenih
 */
Route::get('login/zaposleni',  'ZaposleniController@loginZaposleni') -> name("zaposleni.login");
Route::post('login/zaposleni',  'ZaposleniController@zaposleniLogin') -> name("zaposleni.login.post");
Route::get('logout/zaposleni',  'ZaposleniController@logout') -> name("zaposleni.logout");


/**
 * Administratorske rute
 */
Route::get('film/dodaj', 'AdministratorController@dodavanjeFilma') -> name('administrator.film.dodavanje');
Route::post('film/dodaj', 'AdministratorController@unosFilma') -> name('administrator.film.unos');
Route::get('bioskop/dodaj', 'AdministratorController@dodavanjeBioskopa') -> name('administrator.bioskop.dodavanje');
Route::post('bioskop/dodaj', 'AdministratorController@unosBioskopa') -> name('administrator.bioskop.unos');

Route::get('film/izmeni/{id}', 'AdministratorController@izmenaFilma') -> name('administrator.film.izmena');

Route::post('film/izmeni', 'AdministratorController@izmenaFilmaPost') -> name('administrator.film.izmena.post');

Route::get('zaposleni/brisi', 'AdministratorController@brisiNalog') ->name('administrator.zaposleni.brisi');
Route::post('zaposleni/brisi', 'AdministratorController@brisiNalogPost') ->name('administrator.zaposleni.brisi.post');

Route::get('zaposleni/brisisve', 'AdministratorController@brisiSve') ->name('administrator.zaposleni.brisisve');
Route::post('zaposleni/brisisve', 'AdministratorController@brisiSvePost') ->name('administrator.zaposleni.brisisve.post');

Route::get('kreirajnalog', 'AdministratorController@kreirajNalog') ->name('administrator.kreirajnalog');
Route::post('kreirajnalog', 'AdministratorController@kreirajNalogPost') ->name('administrator.kreirajnalog.post');


/**
 * Menadzerske rute
 */
Route::get('projekcija/dodaj',  'MenadzerController@dodajProjekciju') -> name('menadzer.projekcija.dodavanje');
Route::post('projekcija/dodaj',  'MenadzerController@dodajProjekcijuPost') -> name('menadzer.projekcija.dodavanje.post');
Route::get('projekcije' ,   'MenadzerController@projekcije') -> name('menadzer.projekcije');
Route::get('projekcija/obrisi/{id}' ,   'MenadzerController@obrisiProjekciju') -> name('menadzer.projekcija.obrisi');