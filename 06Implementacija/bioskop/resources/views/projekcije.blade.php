@extends('layouts.master')


@section('title') Pretraga projekcija @stop

@section('content')
    <h2 class="my-3 text-center">Pretraga projekcija</h2>

    @include('partials.errors')
    @include('partials.success')

    <form action="{{ route('projekcije') }}" class="form-inline bg-dark text-light p-2 justify-content-between rounded">

            <label for="bioskop_id">Bioskop:</label>
                <select name="bioskop_id" class="form-control" id="bioskop_id">
                    <option value="">Odaberite bioskop</option>
                    @foreach($bioskopi as $bio)
                        <option {{ $bio == $bioskop ? 'selected' :  '' }} value="{{ $bio -> id }}">{{ $bio -> naziv }} - {{ $bio -> adresa }}</option>
                    @endforeach
                </select>

            <label for="datum">Datum prikazivanja</label>

                <input type="date" class="form-control" id="datum" name="datum" value="{{ request('datum') }}">
            <label for="film_id">Film:</label>
                <select name="film_id" class="form-control" id="film_id">
                    <option value="">Odaberite film</option>
                    @foreach($filmovi as $fil)
                        <option {{ $fil == $film ? 'selected' :  '' }} value="{{ $fil -> id }}">{{ $fil -> naziv }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Prikaži</button>

    </form>

    {{-- Lista projekcija --}}
    @if($projekcije -> isNotEmpty())
        @foreach($projekcije as $projekcija)
            @php
                $film = $projekcija -> film;
            @endphp
            <div class="row my-3 p-4 bg-white rounded">
                <div class="col-md-3 d-flex justify-content-center">
                    <img class="rounded img-thumbnail" src="{{ asset( "storage/" . $film->path) }}" alt="{{ $film -> naziv }}">
                </div>
                <div class="col-md-9">
                    <h3 class="mt-0">{{ $film -> naziv }} - {{ $projekcija -> format_vreme }}</h3>
                    <h4>{{ $projekcija -> bioskop -> naziv }} - {{ $projekcija -> bioskop -> adresa }}</h4>
                    <p>{{ $film -> opis }}</p>
                    <p class="text-muted">{{ $film -> trajanje }} min - <strong>{{ $film -> godina }}</strong> - Režiser: {{ $film -> reziser }} - Glavne uloge: {{ $film -> glavna_uloga }} - Žanrovi: {{ $film -> zanr }}</p>
                    <p class="text-muted">
                        Sala: {{ $projekcija -> broj_sale }}, preostalo mesta: {{ $projekcija -> broj_mesta }}
                    </p>
                    @if($projekcija -> broj_mesta > 0)
                        @korisnik
                        <p class="text-right">
                            <a href="{{ route('rezervacija', $projekcija) }}" class="btn btn-primary">Rezerviši</a>
                        </p>
                        @endkorisnik
                    @endif
                </div>
            </div>
        @endforeach

        {{ $projekcije -> links('partials.paginate') }}
    @else
        <div class="alert alert-warning text-center">Nema projekcija sa odabranim kriterijumom.</div>
    @endif
@stop