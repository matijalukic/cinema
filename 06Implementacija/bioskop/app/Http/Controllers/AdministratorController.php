<?php

namespace App\Http\Controllers;
use App\Film;
use App\Http\Requests\Bioskopi\NoviBioskopRequest;
use App\Http\Requests\Filmovi\IzmenaFilmaRequest;
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
	
	public function dodavanjeBioskopa(){
		return view('zaposleni.dodavanjebioskopa');
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
	
	public function unosBioskopa(NoviBioskopRequest $request)
    {
        try{
            $request -> persist();
            session() -> flash('success', 'Uspešan unos bioskopa!');
        }
        catch(\Exception $e){
            session() -> flash('error', $e -> getMessage());
        }

        return redirect() -> back();
    }

    public function izmenaFilma($id)
    {
        $film = Film::findOrFail($id);

        return view('zaposleni.izmenafilma',[
            'film' => $film
        ]);
    }

    public function izmenaFilmaPost(IzmenaFilmaRequest $request)
    {
        try{
            $request -> persist();
            session() -> flash('success', 'Uspešan unos bioskopa!');
        }
        catch(\Exception $e){
            session() -> flash('error', $e -> getMessage());
        }
        return redirect() -> back();
    }
}
