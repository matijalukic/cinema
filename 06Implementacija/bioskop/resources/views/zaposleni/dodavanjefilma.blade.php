@extends('layouts.zaposleni')


@section('title')Dodaj film - Administrator @stop

@section('content')

    <h1 class="text-center my-3">Dodaj film</h1>

    <form method="POST" action="{{ route('administrator.film.unos') }}">
        {{ csrf_field() }}
        <div class="form-group row">
            <label for="naslovfilma" name="naziv" class="col-sm-2 col-form-label">Naziv filma</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="naslovfilma" placeholder="Unesite naslov filma...">
            </div>
        </div>
        <div class="form-group row">
            <label for="opis" class="col-sm-2 col-form-label">Opis</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="opis" id="opis" rows="3"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="slika" class="col-sm-2 col-form-label">Slika</label>
            <div class="col-sm-10">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="path" id="slika">
                    <label class="custom-file-label" for="slika">Izaberite sliku</label>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="slika" class="col-sm-2 col-form-label">Žanr</label>
            <div class="col-sm-10">
                <select multiple name="zanr[]" class="form-control" id="exampleFormControlSelect2">
                    <option>Akcija</option>
                    <option>Avantura</option>
                    <option>Komedija</option>
                    <option>Drama</option>
                    <option>Horor</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="reditelj" class="col-sm-2 col-form-label">Reditelj</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="reditelj" id="reditelj" placeholder="Unesite reditelja filma...">
            </div>
        </div>

        <div class="form-group row">
            <label for="glumci" class="col-sm-2 col-form-label">Glumci</label>
            <div class="col-sm-10">
                <textarea name="glavna_uloga" class="form-control" placeholder="Unesite glavne glumce filma..." id="glumci" rows="3"></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="godina" class="col-sm-2 col-form-label">Godina</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="godina" id="godina" placeholder="Unesite godinu filma...">
            </div>
        </div>

        <div class="form-group row">
            <label for="trajanje" class="col-sm-2 col-form-label">Trajanje</label>
            <div class="col-sm-10">
                <div class="input-group mb-2">

                    <input type="text" name="trajanje" class="form-control" id="trajanje" placeholder="Trajanje">
                    <div class="input-group-append">
                        <div class="input-group-text">min</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row text-center">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">Dodaj film</button>
            </div>
        </div>
    </form>
@stop