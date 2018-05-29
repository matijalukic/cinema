<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Prikazuje pocetnu stranicu
     */
    public function index( Request $request, $ime = 'Mijusko' )
    {
    	$filmovi = ["Ko to tamo peva", "Lepa sela lepo gore", "Inception", "Ringeraja"]; 


        return view('welcome', [
        	'filmovi' => $filmovi,
        	'ime' => $ime,
        	'godine' => $request -> godine,
        ]);
    }
}
