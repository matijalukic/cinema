<?php

namespace App\Http\Controllers;

use App\Http\Requests\Zaposleni\NovaKartaRequest;
use App\Karta;
use App\Korisnik;
use App\Projekcija;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Relizuje sve operacije dostupne sluzbeniku
 *
 * Class SluzbenikController
 * @package App\Http\Controllers
 */
class SluzbenikController extends Controller
{
    /** Ucitava midllwware sluzbenik
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
        $sve_projekcije = Projekcija::where('vreme', '>', Carbon::now())->orderBy('vreme')->get();
        $svi_korisnici = Korisnik::orderBy('ime')->get();
        $sve_karte = Karta::orderBy('created_at')->get();

        return view('zaposleni.karte', [
            'korisnik' => $korisnik,
            'projekcija' => $projekcija,
            'sve_projekcije' => $sve_projekcije,
            'svi_korisnici' => $svi_korisnici,
            'sve_karte' => $sve_karte,
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

    }catch (CustomException $e)
        {

        session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
}

}
