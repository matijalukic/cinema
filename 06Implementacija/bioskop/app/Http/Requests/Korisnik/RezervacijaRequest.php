<?php

namespace App\Http\Requests\korisnik;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RezervacijaRequest perzistira zahtev za rezervaciju karte korisnika
 * @package App\Http\Requests\Korisnik
 *
 * @author Aleksandar Mijuskovic 580/15
 *
 * @version 1.0
 */
class RezervacijaRequest extends FormRequest
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
            'brkar' => 'required|numeric',
        ];
    }

    public function messages(){
        return[
            'projekcija_id.required' => 'Izaberite projekciju',
            'projekcija_id.exists' => 'Izabrana projekcija ne postoji',
            'brkar.required' => 'Izaberite koliko karata želite',
            'brkar.numeric' => 'Uneta vrednost nije broj',

        ];

    }
}
