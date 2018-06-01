<?php

namespace App\Http\Controllers;

use App\Bioskop;
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

    /**
     * Vraca view koji obavestava korisnika da on nema dozvolu za pristup
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function nemaDozvolu()
    {
        return view('dozvola');
    }
}
