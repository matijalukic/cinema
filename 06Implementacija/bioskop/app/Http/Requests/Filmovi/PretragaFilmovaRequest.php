<?php

namespace App\Http\Requests\Filmovi;

use App\Film;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PretragaFilmovaRequest extends FormRequest
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
            'datum_prikazivanja' => 'date|nullable',
            'naziv' => 'string|nullable',
            'zanr' => ['string', 'nullable', Rule::in(Film::$zanrovi)],
        ];
    }

    /**
     * Dohvata sve filmove na osnovu parametara requesta
     *
     * @return collection \App\Film
     */
    public function filmovi()
    {

        // get film builder
        $filmovi  = Film::where('naziv', 'LIKE' ,'%%');


        // ako je podesen datum
        if($this -> datum_prikazivanja){
            $vremeOd = Carbon::parse($this -> datum_prikazivanja); // pocetak dana
            $vremeDo = Carbon::parse($this -> datum_prikazivanja) -> setTime(23,59); // kraj dana

            $filmovi = $filmovi -> whereHas('projekcije', function($projekcija) use ($vremeOd, $vremeDo){
                $projekcija -> where('vreme', '<', $vremeDo) -> where('vreme', '>=', $vremeOd);
            });

        }
        // ako je podesen naziv
        if(!empty($this -> naziv)){
            $filmovi = $filmovi -> where('naziv', 'LIKE', "%" .$this -> naziv.  "%");
        }
        // zanr je podesen
        if(!empty($this -> zanr)){
            $filmovi = $filmovi -> where('zanr', 'LIKE', '%' . $this -> zanr . '%');
        }


        return $filmovi -> get();

    }
}
