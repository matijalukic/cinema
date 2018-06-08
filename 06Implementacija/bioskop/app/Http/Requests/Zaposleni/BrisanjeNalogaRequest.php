<?php

namespace App\Http\Requests\zaposleni;

use App\Korisnik;
use App\Zaposleni;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BrisanjeNalogaRequest
 * @package App\Http\Requests\zaposleni
 *
 * @author Luka Knezevic 439/15
 *
 * @version 1.0
 */
class BrisanjeNalogaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'zaposlen' => 'array|nullable',
            'korisnik' => 'array|nullable'
        ];
    }


    public function persist()
    {
        if($this->zaposlen)
        foreach($this->zaposlen as $IDzaposlen) {
            $zaposlen = Zaposleni::find($IDzaposlen);
            // administrator ne moze da obrise administratore
            if(!$zaposlen -> jeAdministrator())
                $zaposlen ->delete();
        }

        if($this->korisnik)
        foreach ($this->korisnik as $IDkorisnik){
            Korisnik::find($IDkorisnik)->delete();
        }
    }
}
