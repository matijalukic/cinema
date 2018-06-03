<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $table = "film";
    protected $fillable = ['naziv' , 'zanr', 'path', 'trajanje', 'opis', 'godina', 'reziser', 'glavna_uloga', 'created_at', 'updated_at'];

    static public $zanrovi = ['Akcija', 'Avantura', 'Komedija', 'Drama', 'Horor', 'Kriminal'];

    /**
     * Relacija filma sa projekcijama, pomocu foreign key film_id
     *
     * @return collection \App\Projekcija
     */
    public function projekcije()
    {
        return $this -> hasMany(\App\Projekcija::class, 'film_id');
    }

    /**
     * Iz kolekcije projekcija povezanih sa ovim filmom filtrira one koje nisu prosle, prvih pet uzima
     *
     * @return collection \App\Projekcija
     */
    public function getAktivneProjekcijeAttribute()
    {
        return $this -> projekcije -> filter(function($projekcija, $index){
            return $projekcija -> vreme > Carbon::now();
        }) -> sortBy(function($projekcija){ return $projekcija -> vreme; }) -> take(5);
    }
}
