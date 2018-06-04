<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projekcija extends Model
{
    protected $table = "projekcija";

    /**
     * Vraca bioskop u kome se odrzava projekcija
     *
     * @return \App\Bioskop
     */
    public function bioskop()
    {
        return $this -> hasOne(\App\Bioskop::class, 'id', 'bioskop_id');
    }

    /**
     * Vraca objekat filma za koji se odrzava projekcija
     *
     * @return \App\Film
     */
    public function film()
    {
        return $this -> hasOne(\App\Film::class, 'id', 'film_id');
    }

    /**
     * Zaposelni koji je uneo projekciju
     *
     * @return \App\Zaposleni
     */
    public function zaposleni()
    {
        return $this -> hasOne(\App\Zaposleni::class, 'id', 'zaposleni_id');
    }
    /**
     * Vraca kolekciju rezervacija na koju se odnosi projekcija
     *
     * @return \App\Rezervacija
     */
    public function projekcija()
    {
        return $this -> hasMany(\App\Rezervacija::class, 'projekcija_id', 'id');
    }

}
