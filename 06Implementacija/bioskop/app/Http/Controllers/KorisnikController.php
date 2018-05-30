<?php

namespace App\Http\Controllers;

use App\Http\Requests\Zaposleni\LoginRequest;
use App\Korisnik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KorisnikController extends Controller
{

// Metoda za prikaz formulara za registraciju

    public function registracija(){
        return view('korisnik.registracija');
    }
// Metoda za obradjivanje zahteva za registraciju

    public function registracijaPost(Request $request){
        $name = $request->input('ime');
        $prezime = $request->input('prezime');
        $phone = $request->input('brtel');
        $adresa = $request->input('adresa');
        $email = $request->input('email');
        $username = $request->input('username');
        $jmbg = $request->input('jmbg');
        $password = bcrypt($request->input('password'));

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


        session()->flash('success', 'Uspesno ste se registrovali!');

        return redirect()->back();
    }



}
