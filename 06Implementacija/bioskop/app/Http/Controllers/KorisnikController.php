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

/**
 * Definise operacije koje samo ulogovan korisnik moze da koristi
 *
 * Class KorisnikController
 * @package App\Http\Controllers
 */
class KorisnikController extends Controller
{
    public function __construct()
    {
        // ulogovan korisnik moze da koristi rute iz ovog kontrolera
        $this -> middleware('korisnik');
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
    public function rezervacija(Projekcija $projekcija = null){
        $aktivne_projekcije = Projekcija::where('vreme', '>', Carbon::now(2) -> addMinutes(15))->orderBy('vreme')->get();
        $sve_rezervacije =  Rezervacija::whereHas('projekcija', function($projekcija){$projekcija->where('vreme', '>', Carbon::now(2));})->orderByDesc('created_at')->get();

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
        // kroz transakciju vracamo broj karata
        DB::transaction(function() use ($rezervacija){
            // vracamo broj mesta
            $rezervacija -> projekcija -> broj_mesta += $rezervacija -> broj_karata;
            $rezervacija -> projekcija -> save();
            $rezervacija->delete();
        });
        session()->flash('success', 'Uspesno ste obrisali rezervaciju!');
        return redirect() -> back();
    }
}
