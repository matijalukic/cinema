<?php

namespace App\Http\Requests\Bioskopi;

use App\Projekcija;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class ProjekcijeRequest extends FormRequest
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
            'film_id' => 'nullable|exists:film,id',
            'bioskop_id' => 'nullable|exists:bioskop,id',
            'datum' => 'date|nullable',
        ];
    }

}
