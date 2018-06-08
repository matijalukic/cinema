<?php

namespace App\Http\Requests\Zaposleni;

use App\Exceptions\CustomException;
use App\Zaposleni;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class LoginRequest perzistira zahtev zaposlenog za prijavu
 * @package App\Http\Requests\Zaposleni\
 *
 * @author Aleksandar Mijuskovic 580/15
 *
 * @version 1.0
 */
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
            'username' => 'required|string|exists:zaposleni,username',
            'password' => 'required|string'
        ];
    }

    public function messages(){
        return[
            'username.required' => 'Korisničko ime je obavezno',
            'username.exists' => 'Korisničko nije pronađeno u bazi',
            'password.required' => 'Šifra je obavezna'
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
