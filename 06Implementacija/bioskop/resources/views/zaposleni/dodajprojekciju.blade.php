@extends('layouts.zaposleni')


@section('title')Dodaj bioskop - Administrator @stop

@section('content')

    <h1 class="text-center my-3">Dodaj projekciju</h1>

    @include('partials.success')
    @include('partials.errors')

    @if($filmovi -> isNotEmpty())
    <form action="{{ route('menadzer.projekcija.dodavanje.post') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group row justify-content-center">
            <label for="naslovfilma" class="col-sm-2 col-form-label">Film</label>
            <div class="col-sm-6">
                <select class="custom-select" name="film_id"  id="naslovfilma">
                    @foreach($filmovi as $film)
                        <option {{ old('film_id') == $film -> id ? 'selected' : '' }} value="{{ $film -> id }}">{{ $film -> naziv }} ({{ $film -> godina }})</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row justify-content-center">
            <label for="termin" class="col-sm-2 col-form-label">Termin</label>
            <div class="col-sm-6">
                <input type="time" required class="form-control" id="termin" name="termin" value="{{ old('termin') }}">
            </div>
        </div>
        <div class="form-group row justify-content-center">
            <label for="pocetak" class="col-sm-2 col-form-label">Početak prikazivanja</label>
            <div class="col-sm-6">
                <input type="date" required class="form-control" id="pocetak" name="pocetak" value="{{ old('pocetak') }}">
            </div>
        </div>

        <div class="form-group row justify-content-center">
            <label for="kraj" class="col-sm-2 col-form-label">Kraj prikazivanja</label>
            <div class="col-sm-6">
                <input type="date" required class="form-control" id="kraj" name="kraj" value="{{ old('kraj') }}">
            </div>
        </div>

        <div class="form-group row justify-content-center">
            <label for="sala" class="col-sm-2 col-form-label">Sala</label>
            <div class="col-sm-6">
                <input type="number" name="sala" class="form-control" value="{{old('sala')}}" placeholder="Broj sale" required>
            </div>
        </div>

        <div class="form-group row justify-content-center">
            <label for="cena" class="col-sm-2 col-form-label">Cena karte</label>
            <div class="col-sm-6">
                <div class="input-group mb-2">
                    <input type="number" name="cena" required min="0" value="{{ old('cena') }}" class="form-control" id="cena" placeholder="Cena karte">
                    <div class="input-group-append">
                        <div class="input-group-text">din</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row justify-content-center">
            <label for="mesta" class="col-sm-2 col-form-label">Broj mesta</label>
            <div class="col-sm-6">
                <div class="input-group mb-2">
                    <input type="number" name="mesta" required min="0" value="{{ old('mesta') }}" class="form-control" id="mesta" placeholder="Broj mesta">
                    <div class="input-group-append">
                        <div class="input-group-text">mesta</div>
                    </div>
                </div>
            </div>
        </div>


        <div class="form-group row">
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-primary">Dodaj u repertoar</button>
            </div>
        </div>
    </form>
    @else
        <div class="alert alert-warning">Trenutno ne postoje filmovi u bazi, da bi dodali projekciju moraju postojati filmovi</div>
    @endif

@stop