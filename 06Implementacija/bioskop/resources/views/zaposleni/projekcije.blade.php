@extends('layouts.zaposleni')


@section('title') Projekcije Bioskopa {{ $bioskop -> naziv }} @stop

@section('content')

    <h1 class="text-center my-3">Projekcije - Bioskopa {{ $bioskop -> naziv }}</h1>

    @include('partials.success')
    @include('partials.errors')

    <form action="{{ route('menadzer.projekcije') }}" class="form-inline bg-dark text-light p-2 justify-content-between rounded">

        <label for="datum">Datum prikazivanja</label>
        <input type="date" class="form-control" id="datum" name="datum" value="{{ request('datum') }}">
        
        <label for="film_id">Film:</label>
        <select name="film_id" class="form-control" id="film_id">
            <option value="">Odaberite film</option>
            @foreach($filmovi as $fil)
                <option {{ $fil-> id == request('film_id') ? 'selected' :  '' }} value="{{ $fil -> id }}">{{ $fil -> naziv }}</option>
            @endforeach
        </select>

        <label for="sala">Sala:</label>
        <select name="sala" class="form-control" id="sala">
            <option value="">Odaberite salu</option>
            @foreach($sale as $sala)
                <option {{ $sala == request('sala') ? 'selected' :  '' }} value="{{ $sala }}">{{ $sala }}</option>
            @endforeach
        </select>


        <button type="submit" class="btn btn-primary">Prikaži</button>

    </form>


    @if($projekcije -> isNotEmpty())
        <table class="table table-hover table-striped mt-5">
            <thead>
            <tr>
                <th scope="col">Termin</th>
                <th scope="col">Film</th>
                <th scope="col">Trajanje filma</th>
                <th scope="col">Zaposleni</th>
                <th scope="col">Broj sale</th>
                <th scope="col">Broj mesta</th>
                <th scope="col">Cena</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                @foreach($projekcije as $projekcija)
                <tr class="@if($projekcija -> vreme < \Carbon\Carbon::now()) bg-dark text-white @endif">
                    <th>{{ \Carbon\Carbon::parse($projekcija -> vreme) -> format("H:i d.m.Y") }}</th>
                    <td>{{ $projekcija -> film -> naziv }} ({{ $projekcija -> film -> godina }})</td>
                    <td>{{ $projekcija -> film -> trajanje }} min</td>
                    <td>{{ $projekcija -> zaposleni -> username }}</td>
                    <td class="text-right">{{ $projekcija -> broj_sale }}</td>
                    <td class="text-right">{{ $projekcija -> broj_mesta }}</td>
                    <td class="text-right">{{ $projekcija -> Cena }}</td>
                    <td class="text-right"><a href="{{ route("menadzer.projekcija.obrisi", $projekcija -> id) }}" class="btn btn-outline-danger">Obrisi</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $projekcije -> links('partials.paginate') }}
    @else
        <div class="alert alert-warning">Trenutno ne postoje projekcije za vaš bioskop!</div>
    @endif

@stop