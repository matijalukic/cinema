@extends('layouts.zaposleni')


@section('title')Dodaj bioskop - Administrator @stop

@section('content')

    <h1 class="text-center my-3">Dodaj bioskop</h1>

    @include('partials.success')
    @include('partials.errors')

    <form method="POST" action="{{ route('administrator.bioskop.unos') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group row justify-content-center">
            <label for="NazivBioskopa"  class="col-sm-2 col-form-label">Naziv bioskopa</label>
            <div class="col-sm-6">
                <input type="text" name="naziv" class="form-control" id="nazivbioskopa" placeholder="Unesite naziv bioskopa..." value="{{ old('naziv') }}">
            </div>
        </div>
        <div class="form-group row justify-content-center">
            <label for="adresa" class="col-sm-2 col-form-label">Adresa</label>
            <div class="col-sm-6">
                <textarea class="form-control" name="adresa" id="adresa" rows="3">{{ old('adresa') }}</textarea>
            </div>
        </div>
        <div class="form-group row text-center">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">Dodaj bioskop</button>
            </div>
        </div>
    </form>
@stop