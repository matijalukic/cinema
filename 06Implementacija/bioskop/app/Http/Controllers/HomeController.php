<?php

namespace App\Http\Controllers;

use App\Bioskop;
use App\Film;
use App\Http\Requests\Filmovi\IzmenaFilmaRequest;
use App\Http\Requests\Filmovi\PretragaFilmovaRequest;
use App\Http\Requests\Bioskopi\ProjekcijeRequest;
use App\Projekcija;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class HomeController
 * @package App\Http\Controllers
 *
 * @author Matija Lukic 622/15
 * @author Nikola Zlatic 575/15
 * @version 1.0
 */
class HomeController extends Controller
{
    /**
     * Prikazuje pocetnu stranicu
     */
    public function index()
    {
    	$bioskopi = Bioskop::all();

        return view('welcome', [
        	'bioskopi' => $bioskopi
        ]);
	}

    /**
     * Vraca view koji obavestava korisnika da on nema dozvolu za pristup
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function nemaDozvolu()
    {
        return view('dozvola');
    }

    /**
     * Prikaz liste filmova
     *
     * @param PretragaFilmovaRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filmovi(PretragaFilmovaRequest $request)
    {
        $filmovi  = $request -> filmovi();

        return view('filmovi',
            [
               'filmovi' => $filmovi,
            ]);
    }

    /**
     * Prikaz projekcija bioskopa, sa zadatim kriterijumom u okviru $request
     *
     * @param ProjekcijeRequest $request
     * @param Bioskop $bioskop
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bioskop(ProjekcijeRequest $request, Bioskop $bioskop)
    {
        $film = null;

        $projekcije = Projekcija::where('bioskop_id', $bioskop -> id);
        // filtriramo za film poseban
        if(!empty($request -> film_id)){
            $projekcije = $projekcije -> where('film_id', $request -> film_id);
            $film = Film::find($request -> film_id);
        }

        if(!empty($request -> datum)){
            $pocetakDana = Carbon::parse($request -> datum) -> setTime(0,0);
            $krajDana = Carbon::parse($request -> datum) -> setTime(23,59);

            $projekcije = $projekcije -> where('vreme', '<', $krajDana) -> where('vreme', '>', $pocetakDana);
        }

        $projekcije = $projekcije -> paginate(20);

        return view('projekcije',
            [
                'bioskop' => $bioskop,
                'film' => $film,
                'projekcije' => $projekcije,
                'filmovi' => Film::orderBy('naziv') -> get(),
                'bioskopi' => Bioskop::orderBy('naziv') -> get(),
            ]);
    }

    /**
     * Prikazuje sve projekcije filma i zadatim kriterijumom
     *
     * @param ProjekcijeRequest $request
     * @param Film $film
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function film(ProjekcijeRequest $request, Film $film)
    {
        $bioskop = null;
        // sve projekcije filma
        $projekcije = Projekcija::where('film_id', $film -> id);

        // filtriramo za film poseban
        if(!empty($request -> bioskop_id)){
            $projekcije = $projekcije -> where('bioskop_id', $request -> bioskop_id);
            $bioskop = Bioskop::find($request -> bioskop_id);
        }

        if(!empty($request -> datum)){
            $pocetakDana = Carbon::parse($request -> datum) -> setTime(0,0);
            $krajDana = Carbon::parse($request -> datum) -> setTime(23,59);

            $projekcije = $projekcije -> where('vreme', '<', $krajDana) -> where('vreme', '>', $pocetakDana);
        }

        $projekcije = $projekcije -> paginate(20);

        return view('projekcije',
            [
                'bioskop' => $bioskop,
                'film' => $film,
                'projekcije' => $projekcije,
                'filmovi' => Film::orderBy('naziv') -> get(),
                'bioskopi' => Bioskop::orderBy('naziv') -> get(),
            ]);
    }

    /**
     * Prikazuje projekcije sa zadatim kriterijumom u okvviru $request
     *
     * @param ProjekcijeRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function projekcije(ProjekcijeRequest $request)
    {

        $film = null;
        $bioskop = null;
        // selektuje sve projekcije i vraca query builder
        $projekcije = Projekcija::where('id', '<>', '0');

        if(!empty($request -> bioskop_id)){
            $projekcije = $projekcije -> where('bioskop_id', $request -> bioskop_id);
            $bioskop = Bioskop::find($request -> bioskop_id);
        }

        // filtriramo za film poseban
        if(!empty($request -> film_id)){
            $projekcije = $projekcije -> where('film_id', $request -> film_id);
            $film = Film::find($request -> film_id);
        }

        if(!empty($request -> datum)){
            $pocetakDana = Carbon::parse($request -> datum) -> setTime(0,0);
            $krajDana = Carbon::parse($request -> datum) -> setTime(23,59);

            $projekcije = $projekcije -> where('vreme', '<', $krajDana) -> where('vreme', '>', $pocetakDana);
        }

        $projekcije = $projekcije -> paginate(20);

        return view('projekcije',
            [
                'bioskop' => $bioskop,
                'film' => $film,
                'projekcije' => $projekcije,
                'filmovi' => Film::orderBy('naziv') -> get(),
                'bioskopi' => Bioskop::orderBy('naziv') -> get(),
            ]);
    }

}
