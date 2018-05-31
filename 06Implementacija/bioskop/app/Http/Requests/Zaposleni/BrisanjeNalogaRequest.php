<?php

namespace App\Http\Requests\zaposleni;

use App\Korisnik;
use App\Zaposleni;
use Illuminate\Foundation\Http\FormRequest;

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
            'zaposlen' => 'min:1',
            'korisnik' => 'min:1',
        ];
    }
    public function persist()
    {
        if($this->zaposlen)
        foreach($this->zaposlen as $IDzaposlen) {
            Zaposleni::find($IDzaposlen)->delete();
        }

        if($this->korisnik)
        foreach ($this->korisnik as $IDkorisnik){
            Korisnik::find($IDkorisnik)->delete();
        }
    }
}