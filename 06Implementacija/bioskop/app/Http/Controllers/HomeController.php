<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Prikazuje pocetnu stranicu
     */
    public function index()
    {
        return view('welcome');
    }
}
