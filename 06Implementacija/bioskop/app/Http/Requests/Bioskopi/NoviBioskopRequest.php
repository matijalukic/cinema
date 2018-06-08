<?php

namespace App\Http\Requests\Bioskopi;

use App\Bioskop;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class NoviBioskopRequest perzistira zahtev za dodavanje novog bioskopa
 * @package App\Http\Requests\Bioskopi
 *
 * @author Nikola Zlatic 575/15
 *
 * @version 1.0
 */
class NoviBioskopRequest extends FormRequest
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
			'adresa' => 'required|string|max:30',
        ];
    }

    public function messages()
    {
        return [
            'naziv.required' => 'Naziv bioskopa je obavezan',
            'naziv.max' => 'Naziv može sadržati najviše 20 karaktera',
            'adresa.required' => 'Adresa je obavezna',
            'adresa.max' => 'Adresa može sadržati najviše 30 karaktera',
        ];
    }

    public function persist()
    {

        $noviBioskop = Bioskop::insert([
            'naziv' => $this -> naziv,
            'adresa' => $this -> adresa,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

    }
}
