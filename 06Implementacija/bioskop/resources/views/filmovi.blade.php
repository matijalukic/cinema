@extends('layouts.master')


@section('title')Filmovi @stop

@section('content')
    <h3 class="my-3 text-center">Filmovi naših bioskopa</h3>

    @include('partials.errors')


    <form action="{{ route("filmovi") }}" class="form-inline bg-dark row text-light p-2 justify-content-between rounded">
        {{ csrf_field() }}
        <label for="datum">Datum prikazivanja</label>
        <input type="date" class="form-control mx-2" id="datum" name="datum_prikazivanja" placeholder="Datum prikazivanja" value="{{ request('datum_prikazivanja') }}">
        <label for="naziv">Naziv filma</label>
        <input type="text" class="form-control mx-2" id="naziv" name="naziv" placeholder="Naziv filma" value="{{ request('naziv') }}">


        <label for="zanr">Žanr</label>
        <select class="form-control mx-2" name="zanr" id="zanr">
            <option value="" selected>Svi</option>
            <option {{ strpos(request('zanr'), 'Akcija') !== false ? 'selected' : '' }} value="Akcija">Akcija</option>
            <option {{ strpos(request('zanr'), 'Avantura') !== false ? 'selected' : '' }} value="Avantura">Avantura</option>
            <option {{ strpos(request('zanr'), 'Komedija') !== false ? 'selected' : '' }} value="Komedija">Komedija</option>
            <option {{ strpos(request('zanr'), 'Drama') !== false ? 'selected' : '' }} value="Drama">Drama</option>
            <option {{ strpos(request('zanr'), 'Horor') !== false ? 'selected' : '' }} value="Horor">Horor</option>
            <option {{ strpos(request('zanr'), 'Kriminal') !== false ? 'selected' : '' }} value="Kriminal">Kriminal</option>
        </select>
        <button type="submit" class="btn btn-primary">Prikaži filmove</button>
    </form>

    @if($filmovi -> isNotEmpty())
        @foreach($filmovi as $film)
        <div class="row my-3 p-4 bg-white rounded">
            <div class="col-md-3 justify-content-center d-flex">
                <img class="rounded img-thumbnail img-fluid" src="{{ asset( "storage/" . $film->path) }}" alt="{{ $film -> naziv }}">
            </div>
            <div class="col-md-9">
                <a href="{{ route('film', $film) }}"><h3 class="mt-0">{{ $film -> naziv }}</h3></a>
                <p>{{ $film -> opis }}</p>
                <p class="text-muted">{{ $film -> trajanje }} min - <strong>{{ $film -> godina }}</strong> - Režiser: {{ $film -> reziser }} - Glavne uloge: {{ $film -> glavna_uloga }} - Žanrovi: {{ $film -> zanr }}</p>
                <p class="text-muted">{{ count($film -> aktivne_projekcije) }} projekcija</p>
                @korisnik
                    <div class="btn-group" role="group" aria-label="Projekcije">
                        @foreach($film -> aktivne_projekcije as $projekcija)
                        <a href="{{ route('rezervacija', $projekcija) }}" class="btn btn-outline-primary">{{ \Carbon\Carbon::parse($projekcija -> vreme) -> format('H:i d.m.') }}</a>
                        @endforeach
                    </div>
                @else
                    <div class="btn-group" role="group" aria-label="Projekcije">
                        @foreach($film -> aktivne_projekcije as $projekcija)
                            <span class="btn btn-outline-primary">{{ \Carbon\Carbon::parse($projekcija -> vreme) -> format('H:i d.m.') }}</span>
                        @endforeach
                    </div>
                @endkorisnik
            </div>
        </div>
        @endforeach
    @else
        <div class="alter alert-warning my-3 p-2 text-center">Trenutno nema filmova.</div>
    @endif


@stop