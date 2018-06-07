<?php

namespace App\Http\Requests\Zaposleni;

use Illuminate\Foundation\Http\FormRequest;

class KarteRezervacijeRequest extends FormRequest
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
            'rezervacija_id' => 'exists:rezervacija,id'
        ];
    }

    public function messages(){
        return[
            'rezervacija_id.exists' => 'Rezervacija ne postoji',
        ];

    }
}
