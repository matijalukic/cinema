<?php

namespace App;

use Carbon\Carbon;
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

    /**
     * Pretvara vreme projekcije u formatiran string
     *
     * @return string
     */
    public function getFormatVremeAttribute()
    {
        return Carbon::parse($this -> vreme) -> format("H:i d.m.Y");
    }

    /**
     * Proverava da li je zadati termin u okviru intervala filma
     *
     * @param Carbon $termin
     * @return bool
     */
    public function uTerminuFilma(Carbon $termin)
    {
        $terminProjekcije = Carbon::parse($this -> vreme);
        $krajProjekcije = Carbon::parse($this -> vreme) -> addMinutes($this -> film -> trajanje + 15); // dodaj trajanje filma plus 15 minuta za izlazak iz sale

        return $termin >= $terminProjekcije && $termin <= $krajProjekcije;
    }

}
