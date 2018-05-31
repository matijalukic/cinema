<?php

namespace App\Http\Requests\Korisnik;

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
            'username' => 'required|string',
            'password' => 'required|string'
        ];
    }
    public function persist()
    {

        if( // proveri da li moze da se uloguje
        Auth::attempt([
            'username' => $this -> username,
            'password' => $this -> password,
        ])
        )
        {
            // update updated at timestamp
            $korisnik = Auth::user();
            $korisnik -> updated_at = Carbon::now();
            $korisnik -> save();
        }
    }
}
