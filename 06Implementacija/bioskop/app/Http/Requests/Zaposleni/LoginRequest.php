<?php

namespace App\Http\Requests\Zaposleni;

use App\Exceptions\CustomException;
use App\Zaposleni;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends FormRequest
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
            'username' => 'required|string',
            'password' => 'required|string'
        ];
    }

    public function persist()
    {
        // proveri da li moze da se uloguje
        if( Auth::attempt([     'username' => $this -> username,
                                'password' => $this -> password, ] )
            )
        {
            // update updated at timestamp
            $zaposleni = Auth::user();
            $zaposleni -> updated_at = Carbon::now();
            $zaposleni -> save();
        }
        else
            throw new CustomException('Username ili password nisu ispravno uneti!');

    }
}
