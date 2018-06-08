<?php

namespace App\Http\Requests\Zaposleni;

use App\Korisnik;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BrisanjeSvihNalogaRequest
 * @package App\Http\Requests\Zaposleni
 *
 * @author Luka Knezevic 439/15
 *
 * @version 1.0
 */
class BrisanjeSvihNalogaRequest extends FormRequest
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
            'dana'=> 'required|digits_between:1,10'
        ];
    }

    public function messages(){
        return[
            'dana.required' => 'Broj dana je obavezan',
        ];

    }

    public function persist()
    {
        $korisniciZaBrisanje = Korisnik::where('updated_at', '<', Carbon::now() -> subDays($this->dana)) -> get();
        $br=0;
        foreach ($korisniciZaBrisanje as $korisnik){
            $br++;
            $korisnik -> delete();
        }
        return $br;
    }
}
