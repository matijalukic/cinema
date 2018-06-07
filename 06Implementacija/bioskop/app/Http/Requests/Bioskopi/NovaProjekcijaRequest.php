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
            'film_id' => 'required|exists:film,id',
            'termin' => 'required|date_format:"H:i"',
            'pocetak' => 'required|date',
            'kraj' => 'required|date',
            'sala' => 'required|numeric',
            'cena' => 'required|numeric|min:0',
            'mesta' => 'required|numeric|min:1',
        ];
    }

    public function messages()
    {
        return [
            'film_id.required' => 'Niste izabrali film',
            'film_id.exists' => 'Film ne postoji u bazi',
            'termin.required' => 'Termin filma je obavezan',
            'termin.date_format' => 'Termin mora biti u formatu vremena hh:mm',
            'pocetak.required' => 'Početni datum je obavezan',
            'pocetak.date' => 'Početni datum nije u ispravnom formatu',
            'kraj.required' => 'Krajnji datum je obavezan',
            'kraj.date' => 'Krajnji datum nije u ispravnom formatu',
            'sala.required' => 'Sala je obavezna',
            'sala.numeric' => 'Sala mora biti broj',
            'cena.required' => 'Cena je obavezna',
            'cena.numeric' => 'Cena mora biti broj',
            'cena.min' => 'Cena mora biti veća od 0',
            'mesta.required' => 'Broj mesta je obavezan',
            'mesta.numeric' => 'Broj mesta nije ispravan, mora biti numerik',
            'mesta.min' => 'Minimalan broj mesta je 1',
        ];
    }

    public function persist()
    {
        $film = Film::find($this -> film_id);
        $termin = Carbon::parse($this -> termin);
        $startVreme = Carbon::parse($this -> pocetak);
        $krajVreme = Carbon::parse($this -> kraj);



        // unosimo za sve dane
        while($startVreme <= $krajVreme){
            // postavi vreme za svaku projekciju
            $vremeProjekcije = $startVreme -> setTime($termin -> hour, $termin -> minute);

            $novaProjekcija = new Projekcija;
            $novaProjekcija -> film_id = $film -> id;
            $novaProjekcija -> zaposleni_id = auth() -> user() -> id;
            $novaProjekcija -> bioskop_id = auth() -> user() -> bioskop -> id;
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
