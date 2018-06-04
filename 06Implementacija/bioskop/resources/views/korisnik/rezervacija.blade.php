@extends('layouts.master')


@section('title')Rezervacija @stop

@section('content')

    <h1 class="my-2 text-center">Rezrvacija</h1>
    <h4 class="text-center"> Molimo vas popunite sva polja! </h4>

    @include('partials.errors')
    @include('partials.success')

    <form method="post" action="{{ route('rezervacija.post') }}">
        {{ csrf_field() }}
        <table width="50%" height="50%" align="center" cellpadding="10px">
            <tr>
                <td> Naziv filma: </td>
                <td><input required class="form-control" type="text" name="film" placeholder="Unesite naziv filma"></td>
            </tr>
            <tr>
                <td> Broj karata: </td>
                <td><input required class="form-control" type="number" name="brkar" placeholder="Unesite broj karata"></td>
            </tr>
            <tr>
                <td colspan=2 align=center>
                    <input class="btn btn-primary" type=submit value="Zavrseno!"></td>
            </tr>
        </table>
    </form>
@stop