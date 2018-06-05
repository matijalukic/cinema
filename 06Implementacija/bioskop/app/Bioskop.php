<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Bioskop extends Model
{
    protected $table = "bioskop";
	protected $fillable = ['naziv' , 'adresa', 'created_at', 'updated_at'];

    /**
     * Relacija 1 prema vise sa projekcijama, Bioskop ima vise projekcija
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projekcije()
    {
        return $this -> hasMany(\App\Projekcija::class, 'bioskop_id');
	}

    /**
     * Dohvata najnovije 3 projekcije ovog bioskopa
     * @return collection \App\Projekcija
     */
    public function getSledeceProjekcijeAttribute()
    {
        return $this -> projekcije
            -> filter(function($projekcija, $index){ return $projekcija -> vreme > Carbon::now() && $projekcija -> broj_mesta > 0;})
            -> sortBy(function($projekcija){ return $projekcija -> vreme; }) -> take(3);
	}
}
