<?php

namespace App\Http\Requests\Bioskopi;

use App\Bioskop;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

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
