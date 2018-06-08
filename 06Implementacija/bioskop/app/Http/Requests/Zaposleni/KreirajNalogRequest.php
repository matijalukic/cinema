<?php

namespace App\Http\Requests\Zaposleni;

use App\Administrator;
use App\Menadzer;
use App\SalterskiSluzbenik;
use App\Zaposleni;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

/**
 * Class KreirajNalogRequest kreira nalog zaposlneog korisnika na zahtev administratora
 * @package App\Http\Requests\Zaposleni\
 *
 * @author Luka Knezevic 439/15
 *
 * @version 1.0
 */
class KreirajNalogRequest extends FormRequest
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
            'username' => 'required|string|unique:korisnik,username',
            'jmbg' => 'required|string',
            'password' => 'required|string|confirmed',
            'tip' => ['required', Rule::in(['Sluzbenik', 'Menadzer', 'Administrator'])],
        ];
    }

    public function messages(){
        return[
            'ime.required' => 'Ime je obavezno',
            'prezime.required' => 'Prezime je obavezno',
            'username.required' => 'Korisničko ime je obavezno',
            'username.unique' => 'Korisničko ime je već iskorišćeno, izaberite neko drugo',
            'jmbg.required' => 'Matični broj je obavezan',
            'password.required' => 'Širfa je obavezna',
            'password.confirmed' => 'Šifre se ne podudaraju',
            'tip.required' => 'Tip je obavezan',
            'tip.in' => 'Tip ne postoji'
        ];

    }


    public function persist()
{
    $user = new Zaposleni;
    $user->username=$this ->username;
    $user->ime=$this->ime;
    $user->prezime=$this->prezime;
    $user->jmbg=$this->jmbg;
    $user->password=Hash::make($this ->password);
    $user->bioskop_id=$this->bioskop;

    $user->save();

    if($this->tip == 'Sluzbenik'){
        $user -> bioskop_id = null;
        $user -> save();
        SalterskiSluzbenik::insert([
            'id' => $user->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
    if($this->tip == 'Menadzer'){
        Menadzer::insert([
            'id' => $user->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
    if($this->tip == 'Administrator'){
        Administrator::insert([
            'id' => $user->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

}
}
