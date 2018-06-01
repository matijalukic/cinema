<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bioskop extends Model
{
    protected $table = "bioskop";
	protected $fillable = ['naziv' , 'adresa', 'created_at', 'updated_at'];

    /**
     * Relacija 1 prema vise sa projekcijama, Bioskop ima vise projekcije
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projekcije()
    {
        return $this -> hasMany(\App\Projekcija::class, 'bioskop_id');
	}
}
