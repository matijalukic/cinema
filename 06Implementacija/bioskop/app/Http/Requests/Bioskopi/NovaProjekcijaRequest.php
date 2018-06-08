<?php

namespace App\Http\Requests\Bioskopi;

use App\Bioskop;
use App\Exceptions\CustomException;
use App\Film;
use App\Projekcija;
use App\Repertoar;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class NovaProjekcijaRequest perizstira nove projekcije na zahtev menadzera
 * @package App\Http\Requests\Bioskopi
 *
 * @author Matija Lukic 622/15
 *
 * @version 1.0
 */
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
            'kraj' => 'required|date|after_or_equal:pocetak',
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
            'kraj.after_or_equal' => 'Krajnji datum mora biti nakon početnog datuma ili isti kao datum početka.',
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

        if($startVreme < Carbon::now(2))
            throw new CustomException('Projekcije možete postavljati samo u budućnosti!');
        if($startVreme > $krajVreme)

        // unosimo za sve dane
        while($startVreme <= $krajVreme){
            // postavi vreme za svaku projekciju
            $vremeProjekcije = $startVreme -> setTime($termin -> hour, $termin -> minute);
            // zavrsetak projekcije
            $krajProjekcije = (new Carbon($startVreme)) -> addMinutes($film -> trajanje);

            $pocetakDana = (new Carbon($vremeProjekcije) ) -> setTime(0,0);
            $krajDana = (new Carbon($vremeProjekcije) ) -> setTime(23,59);

            $projekcijeBioskopaSalaDana = Projekcija::where('bioskop_id', auth() -> user() -> bioskop -> id)
                                                    -> where('broj_sale', '=', $this -> sala)
                                                    -> where('vreme', '<', $krajDana) -> where('vreme', '>=', $pocetakDana) -> get();

            // za svaku projekciju tog dana proveru da li ima konflikta
            foreach ($projekcijeBioskopaSalaDana as $projekcijaDana){
                // ako je pocetak ili kraj projekcije upada u interval prikazivanja nekog filma baci gresku
                if($projekcijaDana -> uTerminuFilma($vremeProjekcije) || $projekcijaDana -> uTerminuFilma($krajProjekcije))
                    throw new CustomException('Već postoji projekcija koja je zauzela salu!');
            }

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
