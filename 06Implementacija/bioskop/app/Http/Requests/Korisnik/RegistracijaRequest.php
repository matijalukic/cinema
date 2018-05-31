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
}
