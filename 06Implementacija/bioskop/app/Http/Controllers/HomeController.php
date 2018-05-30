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
	
}
