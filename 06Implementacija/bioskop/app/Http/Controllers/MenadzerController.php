<?php

namespace App\Http\Controllers;

use App\Bioskop;
use App\Film;
use App\Http\Requests\Bioskopi\NovaProjekcijaRequest;
use App\Projekcija;
use App\Repertoar;
use Illuminate\Http\Request;
use Mockery\Exception;

class MenadzerController extends Controller
{
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
    public function projekcije()
    {
        $bioskop = Bioskop::findOrFail(auth() -> user() -> bioskop_id);
        $projekcijeBioskopa = Projekcija::where('bioskop_id', $bioskop -> id) -> orderByDesc('vreme') -> get();

        return view('zaposleni.projekcije', [
            'bioskop' => $bioskop,
            'projekcije' => $projekcijeBioskopa,
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
