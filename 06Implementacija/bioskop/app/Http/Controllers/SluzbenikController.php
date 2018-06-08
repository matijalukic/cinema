<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\Zaposleni\KarteRezervacijeRequest;
use App\Http\Requests\Zaposleni\NovaKartaRequest;
use App\Karta;
use App\Korisnik;
use App\Projekcija;
use App\Rezervacija;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Relizuje sve operacije dostupne sluzbeniku
 *
 * Class SluzbenikController
 * @package App\Http\Controllers
 *
 * @author Matija Lukic 622/15
 *
 * @version 1.0
 *
 */
class SluzbenikController extends Controller
{
    /**
     * Ucitava midllwware sluzbenik
     * SluzbenikController constructor.
     */
    public function __construct()
    {
        $this->middleware('sluzbenik');
    }

    /**
     *  Prikazuje formular za kreiranje karte
     * @param Projekcija|null $projekcija
     * @param Korisnik|null $korisnik
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function prodateKarte(Projekcija $projekcija = null, Korisnik $korisnik = null)
    {
        // Brisati stare rezervacije kojima projekcija je pocela ili pocinje za manje do 15 minuta
        $zastareleRezervacije = Rezervacija::whereHas('projekcija',function($projekcija){
            $projekcija -> where('vreme', '<=', Carbon::now(2) -> addMinutes(15));
        }) -> orderBy('created_at') -> get();

        foreach ($zastareleRezervacije as $rezervacija){
            DB::transaction(function() use ($rezervacija){
                // dodati na projekciju
                $rezervacija -> projekcija -> broj_mesta += $rezervacija -> broj_karata;
                $rezervacija -> projekcija -> save();
                // obrisati rezervaciju
                $rezervacija -> delete();
            });
        }


        // sve rezervacije kojima projekcija ne pocinje u narednih 15 minuta
        $rezervacije = Rezervacija::whereHas('projekcija',function($projekcija){
            $projekcija -> where('vreme', '>', Carbon::now(2) -> addMinutes(15));
        }) -> orderBy('created_at') -> get();
//        dd($rezervacije -> toSql());
        // sve projekcije
        $sve_projekcije = Projekcija::where('vreme', '>', Carbon::now(2))->orderBy('vreme')->get();
        $svi_korisnici = Korisnik::orderBy('ime')->get();
        $sve_karte = Karta::orderBy('created_at')->paginate(50);

        return view('zaposleni.karte', [
            'korisnik' => $korisnik,
            'projekcija' => $projekcija,
            'sve_projekcije' => $sve_projekcije,
            'svi_korisnici' => $svi_korisnici,
            'sve_karte' => $sve_karte,
            'rezervacije' => $rezervacije,
        ]);
    }

    /**
     * Perzistira zahtev za prodaju karata
     * @param NovaKartaRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function prodateKartePost(NovaKartaRequest $request)
    {
        try{

            $projekcija = Projekcija::find($request->projekcija_id);
            $korisnik = Korisnik::find($request->korisnik_id);

            $karta = new Karta;
            $karta->projekcija_id = $projekcija->id;
            $karta->korisnik_id = $korisnik->id;
            $karta->cena = $projekcija->cena;
            $karta->zaposleni_id = auth()->user()->id;

            $karta->save();

            session()->flash('success', 'Karta je uspesno prodata!');

        }
        catch (CustomException $e)
        {

            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }


    /**
     * Prodavanje karta na osnovu rezervacije
     *
     * @param KarteRezervacijeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rezervacijaKarte(KarteRezervacijeRequest $request)
    {
        try{
            $rezervacija = Rezervacija::find($request -> rezervacija_id);
            // napravi broj karata koliko je trazeno u rezervaciji
            for($i = 0; $i < $rezervacija -> broj_karata; $i++){
                $karta = new Karta;

                $karta -> projekcija_id = $rezervacija->projekcija_id;
                $karta -> korisnik_id = $rezervacija -> karta_id;
                $karta -> cena = $rezervacija -> projekcija -> cena;
                $karta -> zaposleni_id = auth()->user()->id;

                $karta->save();
            }

            session()->flash('success', 'Karte su uspešno prodate!');
        }
        catch (CustomException $e)
        {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

}
