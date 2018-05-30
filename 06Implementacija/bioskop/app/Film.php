<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $table = "film";
    protected $fillable = ['naziv' , 'zanr', 'path', 'trajanje', 'opis', 'godina', 'reziser', 'glavna_uloga', 'created_at', 'updated_at'];

}
