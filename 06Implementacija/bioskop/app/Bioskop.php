<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bioskop extends Model
{
    protected $table = "bioskop";
	protected $fillable = ['naziv' , 'adresa', 'created_at', 'updated_at'];

}
