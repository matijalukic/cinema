<?php

namespace App\Http\Controllers;

use App\Http\Requests\Filmovi\NoviFilmRequest;
use Illuminate\Http\Request;
use Mockery\Exception;

class AdministratorController extends Controller
{
    /**
     * Prikazivanje formulara za dodavanje filma
     */
    public function dodavanjeFilma()
    {
        return view('zaposleni.dodavanjefilma');
    }

    public function unosFilma(NoviFilmRequest $request)
    {
        try{
            $request -> persist();
            session() -> flash('success', 'Uspešan unos filma!');
        }
        catch(\Exception $e){
            session() -> flash('error', $e -> getMessage());
        }

        return redirect() -> back();
    }
}
