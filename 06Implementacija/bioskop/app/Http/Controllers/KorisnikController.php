<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\Korisnik\LoginUserRequest;
use App\Http\Requests\Korisnik\RegistracijaRequest;
use App\Korisnik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KorisnikController extends Controller
{
    public function __construct()
    {
        // Korisnik ne sme biti gost da bi se izlogovao
        $this -> middleware('gost') -> except('logout');
        $this -> middleware('korisnik') -> only('logout');
    }

    /**
     * Metoda za prikaz formulara za registraciju
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function registracija(){
        return view('korisnik.registracija');
    }

    /**
     * Metoda za obradjivanje zahteva za registraciju
     *
     * @param RegistracijaRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registracijaPost(RegistracijaRequest $request){
        try{
            $name = $request->input('ime');
            $prezime = $request->input('prezime');
            $phone = $request->input('brtel');
            $adresa = $request->input('adresa');
            $email = $request->input('email');
            $username = $request->input('username');
            $jmbg = $request->input('jmbg');
            $password = Hash::make($request->input('password'));

            $user = new Korisnik;
            $user->username=$username;
            $user->email=$email;
            $user->password=$password;
            $user->ime=$name;
            $user->prezime=$prezime;
            $user->broj=$phone;
            $user->adresa=$adresa;
            $user->jmbg=$jmbg;

            $user->save();

            session()->flash('success', 'Uspesno ste se registrovali! Molimo prijavite se.');
        }catch(CustomException $e){
            session() -> flash('error', $e -> getMessage());
        }
        return redirect() -> back();
    }

    /**
     * Metoda za logovanje korisnika
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loginKorisnik(){
        return view( 'korisnik.login');
    }

    /**
     * Kreiranje sesije za korisnika
     *
     * @param LoginUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function korisnikLogin(LoginUserRequest $request)
    {
        try{
            $request -> persist();
            session() -> flash('success', 'Uspešna prijava!');
            // vraca na home page ako je prijava uspesna
            return redirect() -> route('home');
        }
        catch(CustomException $e){
            session() -> flash('error', $e -> getMessage());
        }
        // vraca nazad u slucaju grese
        return redirect() -> back();
    }

    /**
     * Izloguje korisnika
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        auth()->logout();
        session()->flush();
        session() -> flash('success', 'Uspešna odjava!');
        return redirect() -> route('korisnik.login');
    }


}
