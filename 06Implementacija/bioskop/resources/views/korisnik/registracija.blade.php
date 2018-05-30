@extends('layouts.master')


@section('title')Registracija @stop

@section('content')

    <h1 class="my-2 text-center">Registracija</h1>
    <h3 class="text-center"> Molimo vas popunite sva polja! </h3>

    <form method="post" action="{{ route('registracija.post') }}">
        {{ csrf_field() }}
        <table width="50%" height="50%" align="center" cellpadding="10px">
            <tr>
                <td> Ime: </td>
                <td><input required class="form-control" type="text" name="ime" placeholder="Unesite vase ime"></td>
            </tr>
            <tr>
                <td> Prezime: </td>
                <td><input required class="form-control" type="text" name="prezime" placeholder="Unesite vase prezime"></td>
            </tr>
            <tr>
                <td> Broj Telefona: </td>
                <td><input required class="form-control" type="phone" name="brtel" placeholder="06x/xxx-xxx"></td>
            </tr>
            <tr>
                <td> Adresa: </td>
                <td><input required class="form-control" type="text" name="adresa" placeholder="Unesite adresu boravka"></td>
            </tr>
            <tr>
                <td> JMBG: </td>
                <td><input required class="form-control" type="text" name="jmbg" placeholder="Unesite maticni broj"></td>
            </tr>
            <tr>
                <td> Email Adresa: </td>
                <td><input required class="form-control" type="email" name="email" placeholder="ime@gmail.com"></td>
            </tr>

            <tr>
                <td> Korisnicko Ime: </td>
                <td><input required class="form-control" type="text" name="username" placeholder="Unesite korisnicko ime"></td>
            </tr>
            <tr>
                <td> Lozinka: </td>
                <td><input required class="form-control" type="password" name="password" placeholder="Unesite sifru (do 30 karaktera)"></td>
            </tr>
            <tr>
                <td> Ponovite Lozinku: </td>
                <td><input required class="form-control" type="password" name="password_confirmation" placeholder="Unesite sifru ponovo"></td>
            </tr>
            <tr>
                <td colspan=2 align=center>
                    <input class="btn btn-primary" type=submit value="Zavrseno!"></td>
            </tr>
        </table>
    </form>
@stop