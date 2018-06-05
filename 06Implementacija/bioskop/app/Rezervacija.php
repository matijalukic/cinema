<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rezervacija extends Model
{
    protected $table = "rezervacija";

    /**
     * Vraca projekciju na koju se odnosi rezervacija
     *
     * @return \App\Projekcija
     */
    public function projekcija()
    {
        return $this -> hasOne(\App\Projekcija::class, 'id', 'projekcija_id');
    }

    /**
     * Korisnik koji je rezervisao kartu
     *
     * @return \App\Korisnik
     */
    public function korisnik()
    {
        return $this -> hasOne(\App\Korisnik::class, 'id', 'korisnik_id');
    }

}
