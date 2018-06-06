<?php

namespace App\Http\Requests\Zaposleni;

use Illuminate\Foundation\Http\FormRequest;

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
}
