<?php

namespace App\Http\Controllers;

use App\Film;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Prikazuje pocetnu stranicu
     */
    public function index()
    {
    	$filmovi = Film::all();


        return view('welcome', [
        	'filmovi' => $filmovi
        ]);
    }
}
