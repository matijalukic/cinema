<?php

namespace App\Http\Requests\Zaposleni;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProjekcijeRequest filtrira projekcije na zahtev menadzer u kriterijumu datuma filma i sale
 * @package App\Http\Requests\Zaposleni
 *
 * @author Matija Lukic 622/15
 *
 * @version 1.0
 */
class ProjekcijeRequest extends FormRequest
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
            'datum' => 'nullable|date',
            'film_id' => 'nullable|exists:film,id',
            'sala' => 'nullable|exists:projekcija,broj_sale',
        ];
    }

    public function messages(){
        return[
            'datum.date' => 'Izabrani je prošao',
            'film_id.exists' => 'Izabrana projekcija ne postoji',
            'sala.exists' => 'Izabrana sala ne postoji',
        ];

    }
}
