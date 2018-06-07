<?php

namespace App\Http\Requests\Korisnik;

use App\Exceptions\CustomException;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginUserRequest extends FormRequest
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
            'username' => 'required|string|exists:korisnik,username',
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

        if( // proveri da li moze da se uloguje kao korisnik
            Auth::guard('korisnici') -> attempt([
            'username' => $this -> username,
            'password' => $this -> password,
            ]) )
        {
            // update updated at timestamp
            $korisnik = auth('korisnici') -> user();
            $korisnik -> updated_at = Carbon::now();
            $korisnik -> save();
        }
        else
            throw new CustomException('Username ili password nisu ispravno uneti!');
    }
}
