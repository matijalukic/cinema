<?php

namespace App\Http\Requests\Zaposleni;

use App\Korisnik;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

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
            'dana'=> 'required|digits_between:1,10|'
        ];
    }
    public function persist()
    {
        $korisniciZaBrisanje = Korisnik::where('updated_at', '<', Carbon::now() -> subDays($this->dana)) -> get();

        foreach ($korisniciZaBrisanje as $korisnik) $korisnik -> delete();
    }
}
