<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Relizuje sve operacije dostupne sluzbeniku
 *
 * Class SluzbenikController
 * @package App\Http\Controllers
 */
class SluzbenikController extends Controller
{
    public function __construct()
    {
        $this -> middleware('sluzbenik');
    }
}
