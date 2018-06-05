@extends('layouts.master')


@section('title') Pretraga projekcija @stop

@section('content')
    <h2 class="my-3 text-center">Pretraga projekcija</h2>

    @include('partials.errors')
    @include('partials.success')

    <form action="{{ route('projekcije') }}">

        <div class="form-group row justify-content-center">
            <label for="bioskop_id" class="col-sm-2 col-form-label">Bioskop:</label>
            <div class="col-sm-6">
                <select name="bioskop_id" class="form-control" id="bioskop_id">
                    <option value="">Odaberite bioskop</option>
                    @foreach($bioskopi as $bio)
                        <option {{ $bio == $bioskop ? 'selected' :  '' }} value="{{ $bio -> id }}">{{ $bio -> naziv }} - {{ $bio -> adresa }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row justify-content-center">
            <label for="datum" class="col-sm-2 col-form-label">Datum prikazivanja</label>
            <div class="col-sm-6">
                <input type="date" class="form-control" id="datum" name="datum" value="{{ request('datum') }}">
            </div>
        </div>

        <div class="form-group row justify-content-center">
            <label for="film_id" class="col-sm-2 col-form-label">Film:</label>
            <div class="col-sm-6">
                <select name="film_id" class="form-control" id="film_id">
                    <option value="">Odaberite film</option>
                    @foreach($filmovi as $fil)
                        <option {{ $fil == $film ? 'selected' :  '' }} value="{{ $fil -> id }}">{{ $fil -> naziv }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row justify-content-center">
            <div class="col-sm-6 text-center">
                <button type="submit" class="btn btn-primary">Prikaži</button>
            </div>
        </div>

    </form>

    @if($projekcije -> isNotEmpty())
    @foreach($projekcije as $projekcija)
        @php
            $film = $projekcija -> film;
        @endphp
        <div class="media my-3">
            <img class="mr-3" src="{{ asset( "storage/" . $film->path) }}" alt="{{ $film -> naziv }}">
            <div class="media-body">
                <h3 class="mt-0">{{ $film -> naziv }} - {{ $projekcija -> format_vreme }}</h3>
                <p>{{ $film -> opis }}</p>
                <p class="text-muted">{{ $film -> trajanje }} min - <strong>{{ $film -> godina }}</strong> - Režiser: {{ $film -> reziser }} - Glavne uloge: {{ $film -> glavna_uloga }} - Žanrovi: {{ $film -> zanr }}</p>
                <p class="text-muted">
                    Sala: {{ $projekcija -> broj_sale }}, preostalo mesta: {{ $projekcija -> broj_mesta }}
                </p>
                @if($projekcija -> broj_mesta > 0)
                    <p class="text-right">
                        <a href="{{ route('rezervacija', $projekcija) }}" class="btn btn-primary">Rezerviši</a>
                    </p>
                @endif
            </div>
        </div>
    @endforeach
    @else
        <div class="alert alert-warning text-center">Nema projekcija sa odabranim kriterijumom.</div>
    @endif
@stop