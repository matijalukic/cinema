<?php

namespace App\Http\Controllers;

use App\Bioskop;
use App\Film;
use App\Http\Requests\Bioskopi\NovaProjekcijaRequest;
use App\Http\Requests\Zaposleni\ProjekcijeRequest;
use App\Projekcija;
use App\Repertoar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mockery\Exception;

/**
 * Realizuje sve operacije dostupne menadzeru
 *
 * Class MenadzerController
 * @package App\Http\Controllers
 */
class MenadzerController extends Controller
{
    public function __construct()
    {
        $this -> middleware('menadzer');
    }


    /**
     * Ispisuje formular za dodavanje projekcije
     */
    public function dodajProjekciju()
    {
        $filmovi = Film::orderBy('naziv') -> get();

        return view('zaposleni.dodajprojekciju', [
            'filmovi' => $filmovi,
        ]);
    }

    /**
     * Obradjuje zahtev za novom projekcijom i dodaje je u bazi
     *
     * @param NovaProjekcijaRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function dodajProjekcijuPost(NovaProjekcijaRequest $request)
    {
        try{
            $request -> persist();
            session() -> flash('success', 'Uspešan unos projekcije!');
        }
        catch(Exception $e){
            session() -> flash('error', $e -> getMessage());
        }
        return redirect() -> back();
    }

    /**
     * Prosledjuje view-u listu svih projekcija iz bioskopa u kome je menadzer zaposlen
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function projekcije(ProjekcijeRequest $request)
    {
        $projekcijeBioskopa = Projekcija::where('bioskop_id', auth() -> user() -> bioskop -> id);

        // filtriraj po broju sale
        if(!empty($request -> broj_sale))
            $projekcijeBioskopa = $projekcijeBioskopa -> where('broj_sale', $request -> broj_sale);

        // filtriraj po datumu
        if(!empty($request -> datum)){
            $pocetakDana = Carbon::parse($request -> datum) -> setTime(0, 0);
            $krajDana = Carbon::parse($request -> datum) -> setTime(23, 59);

            $projekcijeBioskopa = $projekcijeBioskopa -> where('vreme', '<', $krajDana) -> where('vreme', '>', $pocetakDana);
        }

        // filtriraj po filmu
        if(!empty($request -> film_id)){
            $projekcijeBioskopa = $projekcijeBioskopa -> where('film_id', $request -> film_id);
        }




        $bioskop = Bioskop::findOrFail(auth() -> user() -> bioskop_id);
        $projekcijeBioskopa = $projekcijeBioskopa -> orderByDesc('vreme') -> paginate(20);
        $sale = Projekcija::where('bioskop_id', auth() -> user() -> bioskop -> id) -> orderBy('broj_sale') -> get() -> pluck('broj_sale')-> unique(); // dohvati sve sale


        return view('zaposleni.projekcije', [
            'bioskop' => $bioskop,
            'projekcije' => $projekcijeBioskopa,
            'sale' => $sale,
            'filmovi' => Film::orderBy('naziv') -> get(),
        ]);
    }

    public function obrisiProjekciju( $id )
    {
        $projekcija = Projekcija::findOrFail($id);

        $projekcija -> delete();
        session() -> flash('success', 'Projekcija je obrisana!');

        return redirect() -> back();
    }
}
