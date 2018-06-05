<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karta extends Model
{
    protected $table = "karta";

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projekcija()
    {
        return $this -> hasOne(\App\Projekcija::class, 'id', 'projekcija_id');
    }
    public function korisnik()
    {
        return $this -> hasOne(\App\Korisnik::class, 'id', 'korisnik_id');
    }
}
