<?php

namespace App\Http\Requests\Korisnik;

use Illuminate\Foundation\Http\FormRequest;

class RegistracijaRequest extends FormRequest
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
            'ime' => 'required|string',
            'prezime' => 'required|string',
            'brtel' => 'required|string',
            'adresa' => 'required|string',
            'email' => 'required|email',
            'username' => 'required|string|unique:korisnik,username',
            'jmbg' => 'required|string',
            'password' => 'required|string|confirmed',
        ];
    }
    public function messages(){
        return[
            'ime.required' => 'Ime je obavezno',
            'prezime.required' => 'Prezime j eobavezno',
            'brtel.required' => 'Broj telefona je obavezan',
            'adresa.required' => 'Adresa je obavezna',
            'email.required' => 'Email je obavezan',
            'email.email' => 'Email nije ispravno unet',
            'username.required' => 'Korisničko ime je obavezno',
            'username.unique' => 'Korisničko ime je već iskorišćeno, izaberite neko drugo',
            'jmbg.required' => 'Matični broj je obavezan',
            'password.required' => 'Šifra je obavezna',
            'password.confirmed' => 'Šifre se ne podudaraju',

        ];

    }
}
