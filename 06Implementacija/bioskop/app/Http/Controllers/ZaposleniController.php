<?php

namespace App\Http\Controllers;

use App\Http\Requests\Zaposleni\LoginRequest;
use Illuminate\Http\Request;

/**
 * Class ZaposleniController
 * @package App\Http\Controllers
 *
 * @author Aleksandar Mijuskovic 580/15
 *
 * @version 1.0
 */
class ZaposleniController extends Controller
{
    public function __construct()
    {
        // korisnik mora biti gost da bi video login
        $this -> middleware('gost') -> only(['loginZaposleni', 'zaposleniLogin']);
        // Korisnik mora biti ulogovan kao zaposleni da bi izvrsio operacije, osim logina
        $this -> middleware('zaposleni') -> except(['loginZaposleni', 'zaposleniLogin']);
    }
    
    /**
     * Pocetna stranica za sve zaposlene
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('zaposleni.index');
    }

    /**
     * Formular za login zaposlenih
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loginZaposleni()
    {
        return view('zaposleni.login');
    }

    /**
     * Stavara sesiju ukoliko su kredencijali ispravno uneti
     */
    public function zaposleniLogin(LoginRequest $request)
    {
        try{
            $request -> persist();
            session() -> flash('success', 'Uspešna prijava!');

            // uspesna prijava registruj se
            return redirect() -> route('zaposleni.index');
        }
        catch(\Exception $e){
            session() -> flash('error', $e -> getMessage());
        }

        // return back u slucaju greske
        return redirect() -> back();
    }

    /**
     * Brise sesije loggovanih zaposlenih
     */
    public function logout()
    {
        auth()->logout();
        session()->flush();
        session() -> flash('success', 'Uspešna odjava!');
        return redirect() -> route('zaposleni.login');

    }
}
