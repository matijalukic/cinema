<?php

namespace App\Http\Controllers;

use App\Bioskop;
use App\Film;
use Illuminate\Http\Request;

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
	
	public function svifilmovi(Request $request){
		$bioskopi = Bioskop::all();
		//dd($request->datum); za debagovanje
		
        return view('svifilmovi', [
        	'bioskopi' => $bioskopi,
			'datum' => $request->datum,
        ]);
	}
	
	/*public static function svifilmovi1($v = 1){
		$bioskopi = Bioskop::all();

        return view('svifilmovi', [
        	'bioskopi' => $bioskopi,
			'v' => $v,
        ]);
	}
	*/
	/*
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
*/

	
}
