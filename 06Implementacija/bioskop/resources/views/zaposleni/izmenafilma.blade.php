@extends('layouts.zaposleni')


@section('title')Izmeni film - {{$film -> naziv}} @stop

@section('content')

    <h1 class="text-center my-3">Izmena filma</h1>

    @include('partials.success')
    @include('partials.errors')

    <form method="post" action="{{ route("administrator.film.izmena.post") }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{$film ->id}}">
        <div class="form-group row">
            <label for="naziv" class="col-sm-2 col-form-label">Naslov filma</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="naziv" id="naziv" value="{{ $film -> naziv}}" placeholder="Unesite naziv filma...">
            </div>
        </div>
        <div class="form-group row">
            <label for="opis" class="col-sm-2 col-form-label">Opis</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="opis" id="opis" rows="3">{{$film->opis}}</textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="slika" class="col-sm-2 col-form-label">Slika</label>
            <div class="col-sm-10">
                <img src="{{ asset( "storage/" . $film->path) }}" class="img-fluid">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="slika" name="path">
                    <label class="custom-file-label" for="slika">Izaberite sliku</label>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="zanr" class="col-sm-2 col-form-label">Žanr</label>
            <div class="col-sm-10">
                <select multiple class="form-control" name="zanr[]" id="zanr">
                    <option {{ strpos($film -> zanr, 'Akcija') !== false ? 'selected' : '' }} value="Akcija">Akcija</option>
                    <option {{ strpos($film -> zanr, 'Avantura') !== false ? 'selected' : '' }} value="Avantura">Avantura</option>
                    <option {{ strpos($film -> zanr, 'Komedija') !== false ? 'selected' : '' }} value="Komedija">Komedija</option>
                    <option {{ strpos($film -> zanr, 'Drama') !== false ? 'selected' : '' }} value="Drama">Drama</option>
                    <option {{ strpos($film -> zanr, 'Horor') !== false ? 'selected' : '' }} value="Horor">Horor</option>
                    <option {{ strpos($film -> zanr, 'Kriminal') !== false ? 'selected' : '' }} value="Kriminal">Kriminal</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="reditelj" class="col-sm-2 col-form-label">Reditelj</label>
            <div class="col-sm-10">
                <input type="text" name="reditelj" value="{{ $film -> reziser}}" class="form-control" id="reditelj" placeholder="Unesite reditelja filma...">
            </div>
        </div>

        <div class="form-group row">
            <label for="glumci" class="col-sm-2 col-form-label">Glumci</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="glavna_uloga"   placeholder="Unesite glavne glumce filma..." id="glumci" rows="3">{{$film->glavna_uloga}}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="godina" class="col-sm-2 col-form-label">Godina</label>
            <div class="col-sm-10">
                <input type="number" name="godina" value="{{ $film -> godina}}" class="form-control" id="godina" placeholder="Unesite godinu filma...">
            </div>
        </div>

        <div class="form-group row">
            <label for="godina" class="col-sm-2 col-form-label">Trajanje</label>
            <div class="col-sm-10">
                <div class="input-group mb-2">

                    <input type="text" name="trajanje" value="{{ $film -> trajanje}}" class="form-control" id="trajanje" placeholder="Trajanje">
                    <div class="input-group-append">
                        <div class="input-group-text">min</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-primary">Sacuvaj izmene</button>
                <button type="reset" class="btn btn-secondary">Ponisti</button>
            </div>
        </div>
    </form>

@stop