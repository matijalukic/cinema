<?php

namespace App\Http\Controllers;

use App\Http\Requests\Korisnik\LoginUserRequest;
use App\Http\Requests\Korisnik\RegistracijaRequest;
use App\Korisnik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KorisnikController extends Controller
{

// Metoda za prikaz formulara za registraciju

    public function registracija(){
        return view('korisnik.registracija');
    }
// Metoda za obradjivanje zahteva za registraciju

    public function registracijaPost(RegistracijaRequest $request){

        $name = $request->input('ime');
        $prezime = $request->input('prezime');
        $phone = $request->input('brtel');
        $adresa = $request->input('adresa');
        $email = $request->input('email');
        $username = $request->input('username');
        $jmbg = $request->input('jmbg');
        $password = Hash::make($request->input('password'));

        $user = new Korisnik();
        $user->korime=$username;
        $user->email=$email;
        $user->password=$password;
        $user->ime=$name;
        $user->prezime=$prezime;
        $user->broj=$phone;
        $user->adresa=$adresa;
        $user->jmbg=$jmbg;

        $user->save();

        try{
        session()->flash('success', 'Uspesno ste se registrovali!');
        }catch(\Exception $e){
            session() -> flash('error', $e -> getMessage());
        }
        return redirect() -> route('home');
    }

// Metoda za logovanje korisnika
    public function loginKorisnik(){
        return view( 'korisnik.login');
    }
    public function korisnikLogin(LoginUserRequest $request)
    {
        try{
            $request -> persist();
            session() -> flash('success', 'Uspešna prijava!');
        }
        catch(\Exception $e){
            session() -> flash('error', $e -> getMessage());
        }
        return redirect() -> route('home');
    }

    /**
     * Brise sesije loggovanih korisnika
     */
    public function logout()
    {
        auth()->logout();
        session()->flush();
        session() -> flash('success', 'Uspešna odjava!');
        return redirect() -> route('korisnik.login');

    }


}
