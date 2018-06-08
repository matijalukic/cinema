<?php

namespace App\Http\Requests\Bioskopi;

use App\Projekcija;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProjekcijeRequest validira parametre za pretragu projekcija
 * @package App\Http\Requests\Bioskopi
 *
 * @author Nikola Zlatic 575/15
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
            'film_id' => 'nullable|exists:film,id',
            'bioskop_id' => 'nullable|exists:bioskop,id',
            'datum' => 'date|nullable',
        ];
    }

    public function messages()
    {
        return [
            'film_id.exists' => 'Odabrani film ne postoji',
            'bioskop_id.exists' => 'Odabrani bioskop ne postoji',
            'datum.date' => 'Odabrani datum nije validnog formata',
        ];
    }

}
