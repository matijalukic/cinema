<?php

namespace App\Http\Requests\Zaposleni;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class NovaKartaRequest perzistira zahtev sluzbenika za prodaju karte
 * @package App\Http\Requests\Zaposleni
 *
 * @author Matija Lukic 622/15
 *
 * @version 1.0
 */
class NovaKartaRequest extends FormRequest
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
            'projekcija_id' => 'required|exists:projekcija,id',
            'korisnik_id' => 'required|exists:korisnik,id'
        ];
    }
    public function messages(){
        return[
            'rezervacija_id.exists' => 'Rezervacija ne postoji',
            'korisnik_id.exists' => 'Izabrani korisnik ne postoji ne postoji',
        ];

    }
}
