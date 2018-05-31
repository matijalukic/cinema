@extends('layouts.zaposleni')


@section('title') Projekcije Bioskopa {{ $bioskop -> naziv }} @stop

@section('content')

    <h1 class="text-center my-3">Projekcije - Bioskopa {{ $bioskop -> naziv }}</h1>

    @include('partials.success')
    @include('partials.errors')

    @if($projekcije -> isNotEmpty())
        <table class="table table-hover">
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
                <tr>
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
    @else
        <div class="alert alert-warning">Trenutno ne postoje projekcije za vaš bioskop!</div>
    @endif

@stop