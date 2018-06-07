<?php

namespace App\Http\Requests\Filmovi;

use App\Film;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class IzmenaFilmaRequest extends FormRequest
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
            'naziv' => 'required|string|max:20',
            'opis' => 'required|string',
            'zanr' => 'required|array|min:1',
            'path' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'reditelj' => 'required|string',
            'glavna_uloga' => 'required|string',
            'godina' => 'required|digits:4',
            'trajanje' => 'required|numeric|min:1',
            'id' => 'required|exists:film,id'
        ];
    }

    public function messages()
    {
        return [
            'naziv.required' => 'Naziv je obavezan',
            'naziv.max' => 'Naziv sadrži najviše 20 znakova',
            'opis.required' => 'Opis je obavezan',
            'zanr.required' => 'Žanr je obavezan',
            'zanr.min' => 'Morate izabrati barem jedan žanr',
            'path.image' => 'Morate uploadovati sliku',
            'path.mimes' => 'Slika filma nije ispravnog formata',
            'reditelj.required' => 'Režiser je obavezan',
            'glavna_uloga.required' => 'Glumci su obavezno polje',
            'godina.required' => 'Godina je obavezno polje',
            'godina.digits' => 'Godina mora imati 4 cifre',
            'trajanje.required' => 'Trajanje je obavezno polje',
            'trajanje.min' => 'Trajanje mora biti minimalno jedan minut',
            'id.required' => 'Film za izmenu je obavezan',
            'id.exists' => 'Nije pronadjen film koji se izmenjuje',
        ];
    }

    public function persist()
    {
        // upload slike
        if($this -> path){
            $slika = $this -> path -> store('filmovi', 'public');}
        else{
            $slika = Film::find($this -> id)->path;
        }


        $noviFilm = Film::updateOrCreate(
            ['id' =>$this -> id],
        [
            'naziv' => $this -> naziv,
            'opis' => $this -> opis,
            'reziser' => $this -> reditelj,
            'glavna_uloga' => $this -> glavna_uloga,
            'godina' => $this -> godina,
            'trajanje' => $this -> trajanje,
            'path' => $slika,
            'zanr' => implode(",", $this -> zanr),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
