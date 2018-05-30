<?php

namespace App\Http\Requests\Bioskopi;

use App\Bioskop;
use App\Film;
use App\Projekcija;
use App\Repertoar;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class NovaProjekcijaRequest extends FormRequest
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
            'repertoar_id' => 'required|exists:repertoar,id',
            'film_id' => 'required|exists:film,id',
            'termin' => 'required|date_format:"H:i"',
            'pocetak' => 'required|date',
            'kraj' => 'required|date',
            'sala' => 'required|numeric',
            'cena' => 'required|numeric',
            'mesta' => 'required|numeric|min:1',
        ];
    }

    public function persist()
    {

        $repertoar = Repertoar::find($this -> repertoar_id);
        $film = Film::find($this -> film_id);
        $termin = Carbon::parse($this -> termin);
        $startVreme = Carbon::parse($this -> pocetak);
        $krajVreme = Carbon::parse($this -> kraj);


        // @todo dohvati bioskop na osnovu ulogovanog menadzera
        $bioskop = Bioskop::find(1);

        // unosimo za sve dane
        while($startVreme <= Carbon::parse($this -> kraj)){
            // postavi vreme za svaku projekciju
            $vremeProjekcije = $startVreme -> setTime($termin -> hour, $termin -> minute);

            $novaProjekcija = new Projekcija;
            $novaProjekcija -> film_id = $film -> id;
            $novaProjekcija -> repertoar_id = $repertoar -> id;
            $novaProjekcija -> bioskop_id = $bioskop -> id;
            $novaProjekcija -> broj_sale = $this -> sala;
            $novaProjekcija -> broj_mesta = $this -> mesta;
            $novaProjekcija -> cena = $this -> cena;
            $novaProjekcija -> vreme = $vremeProjekcije;
            $novaProjekcija -> save();

            // dodaj dan
            $startVreme = $startVreme -> addDay();
        }
    }
}
