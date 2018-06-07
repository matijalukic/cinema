<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Zaposleni extends Authenticatable
{
    use Notifiable;
    protected $table = 'zaposleni';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Relacija bioskop u kome radi Menadzer ili Sluzbenik
     * @return \App\Bioskop? nullable
     */
    public function bioskop()
    {
        return $this -> hasOne(\App\Bioskop::class, 'id', 'bioskop_id');
    }

    /**
     * Proverava da li je ovaj zaposleni administrator
     *
     * @return bool
     */
    public function jeAdministrator()
    {
        return Administrator::where('id', $this -> id) -> exists();
    }
}
