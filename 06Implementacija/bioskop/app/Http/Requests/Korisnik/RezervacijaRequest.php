<?php

namespace App\Http\Requests\korisnik;

use Illuminate\Foundation\Http\FormRequest;

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
}
