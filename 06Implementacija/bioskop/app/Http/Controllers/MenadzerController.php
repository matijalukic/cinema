<?php

namespace App\Http\Controllers;

use App\Film;
use App\Http\Requests\Bioskopi\NovaProjekcijaRequest;
use App\Repertoar;
use Illuminate\Http\Request;
use Mockery\Exception;

class MenadzerController extends Controller
{
    /**
     *   Ispisuje formular za dodavanje projekcije
     */
    public function dodajProjekciju()
    {
        $filmovi = Film::orderBy('naziv') -> get();

        // @todo u zavisnosti koji je menadzer ulogovan izabrati repertoars
        $repertoar = Repertoar::where('zaposleni_id', 1) -> first();

        return view('zaposleni.dodajprojekciju', [
            'filmovi' => $filmovi,
            'repertoar' => $repertoar,
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
}
