@extends('layouts.zaposleni')


@section('title')Dodaj film - Administrator @stop

@section('content')

    <h1 class="text-center my-3">Dodaj film</h1>

    @include('partials.success')
    @include('partials.errors')

    <form method="POST" action="{{ route('administrator.film.unos') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group row justify-content-center">
            <label for="naslovfilma"  class="col-sm-2 col-form-label">Naziv filma</label>
            <div class="col-sm-6">
                <input type="text" name="naziv" class="form-control" id="naslovfilma" placeholder="Unesite naslov filma..." value="{{ old('naziv') }}">
            </div>
        </div>
        <div class="form-group row justify-content-center">
            <label for="opis" class="col-sm-2 col-form-label">Opis</label>
            <div class="col-sm-6">
                <textarea class="form-control" name="opis" id="opis" rows="3">{{ old('opis') }}</textarea>
            </div>
        </div>
        <div class="form-group row justify-content-center">
            <label for="slika" class="col-sm-2 col-form-label">Slika</label>
            <div class="col-sm-6">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="path" id="slika">
                    <label class="custom-file-label" for="slika">Izaberite sliku</label>
                </div>
            </div>
        </div>

        <div class="form-group row justify-content-center">
            <label for="zanr" class="col-sm-2 col-form-label">Žanr</label>
            <div class="col-sm-6">
                <select multiple name="zanr[]" class="form-control" id="zanr">
                    <option {{ old('zanr') && in_array('Akcija', old('zanr')) ? 'selected' : '' }} value="Akcija">Akcija</option>
                    <option {{ old('zanr') && in_array('Avantura', old('zanr')) ? 'selected' : '' }} value="Avantura">Avantura</option>
                    <option {{ old('zanr') && in_array('Komedija', old('zanr')) ? 'selected' : '' }} value="Komedija">Komedija</option>
                    <option {{ old('zanr') && in_array('Drama', old('zanr')) ? 'selected' : '' }} value="Drama">Drama</option>
                    <option {{ old('zanr') && in_array('Horor', old('zanr')) ? 'selected' : '' }} value="Horor">Horor</option>
                    <option {{ old('zanr') && in_array('Kriminal', old('zanr')) ? 'selected' : '' }} value="Kriminal">Kriminal</option>
                </select>
            </div>
        </div>

        <div class="form-group row justify-content-center">
            <label for="reditelj" class="col-sm-2 col-form-label">Reditelj</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="reditelj" id="reditelj" placeholder="Unesite reditelja filma..." value="{{ old('reditelj') }}">
            </div>
        </div>

        <div class="form-group row justify-content-center">
            <label for="glumci" class="col-sm-2 col-form-label">Glumci</label>
            <div class="col-sm-6">
                <textarea name="glavna_uloga" class="form-control" placeholder="Unesite glavne glumce filma..." id="glumci" rows="3">{{ old('glavna_uloga') }}</textarea>
            </div>
        </div>

        <div class="form-group row justify-content-center">
            <label for="godina" class="col-sm-2 col-form-label">Godina</label>
            <div class="col-sm-6">
                <input type="number" class="form-control" name="godina" id="godina" placeholder="Unesite godinu filma..." value="{{ old('godina') }}">
            </div>
        </div>

        <div class="form-group row justify-content-center">
            <label for="trajanje" class="col-sm-2 col-form-label">Trajanje</label>
            <div class="col-sm-6">
                <div class="input-group mb-2">

                    <input type="text" name="trajanje" class="form-control" id="trajanje" value="old('trajanje')" placeholder="Trajanje">
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