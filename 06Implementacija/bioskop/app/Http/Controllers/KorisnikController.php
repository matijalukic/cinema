<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\Korisnik\LoginUserRequest;
use App\Http\Requests\Korisnik\RegistracijaRequest;
use App\Http\Requests\korisnik\RezervacijaRequest;
use App\Korisnik;
use App\Projekcija;
use App\Rezervacija;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Illuminate\Database\MySqlConnection;

class KorisnikController extends Controller
{
    public function __construct()
    {
        // Korisnik ne sme biti gost da bi se izlogovao
        $this -> middleware('gost') -> only(['registracija', 'registracijaPost', 'loginKorisnik', 'korisnikLogin']);
        $this -> middleware('korisnik') -> except(['registracija', 'registracijaPost', 'loginKorisnik', 'korisnikLogin']);

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

    /**
     * Prikazuje formular za rezervaciju i sve korisnikove rezervacije koje nisu prosle
     * @param Projekcija|null $projekcija
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function rezervacija(Projekcija $projekcija=null){
        $aktivne_projekcije = Projekcija::where('vreme', '>', Carbon::now())->orderBy('vreme')->get();
        $sve_rezervacije =  Rezervacija::whereHas('projekcija', function($projekcija){$projekcija->where('vreme', '>', Carbon::now());})->orderByDesc('created_at')->get();

        return view('korisnik.rezervacija', [
            'projekcija' => $projekcija,
            'aktivne_projekcije' => $aktivne_projekcije,
            'sve_rezervacije' => $sve_rezervacije
        ]);
    }

    /**
     * Perzistira zahtev za registraciju u bazu
     * @param RezervacijaRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rezervacijaPost(RezervacijaRequest $request){
        try{
        $projekcija = Projekcija::find($request->projekcija_id);
        $brkar = $request->input('brkar');
        if($brkar > $projekcija->broj_mesta) throw new CustomException('Nema dovoljno mesta za datu projekciju!');

        $rez = new Rezervacija;

        $rez->broj_karata = $brkar;
        $rez->projekcija_id = $projekcija->id;
        $rez->korisnik_id = auth("korisnici")->user()->id;
        $projekcija->broj_mesta-=$brkar;


        $projekcija->save();
        $rez->save();


        session()->flash('success', 'Uspesno ste rezervisali kartu!');

        }catch(CustomException $e){

            session() -> flash('error', $e -> getMessage());
        }
            return redirect() -> back();
    }

    /**
     * Brise datu rezervaciju sa id-em
     * @param Rezervacija $rezervacija
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function obrisiRezervaciju(Rezervacija $rezervacija){

        $rezervacija->delete();
        session()->flash('success', 'Uspesno ste obrisali rezervaciju!');
        return redirect() -> back();
    }
}
