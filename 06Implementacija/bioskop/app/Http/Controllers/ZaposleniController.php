<?php

namespace App\Http\Controllers;

use App\Http\Requests\Zaposleni\LoginRequest;
use Illuminate\Http\Request;

class ZaposleniController extends Controller
{
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
        }
        catch(\Exception $e){
            session() -> flash('error', $e -> getMessage());
        }
        return redirect() -> route('administrator.film.dodavanje');
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
