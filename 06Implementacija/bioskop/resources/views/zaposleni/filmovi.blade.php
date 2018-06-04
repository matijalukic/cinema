@extends('layouts.zaposleni')


@section('title')Filmovi @stop

@section('content')

    <h1 class="text-center my-3">Filmovi</h1>

    @include('partials.success')
    @include('partials.errors')

    @if($filmovi -> isNotEmpty())
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Naziv</th>
                <th scope="col">Godina</th>
                <th scope="col">Broj projekcija</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($filmovi as $film)
                <tr>
                    <th>{{ $film -> naziv }}</th>
                    <td>{{ $film -> godina  }}</td>
                    <td class="text-right">{{ count($film -> projekcije)}}</td>
                    <td class="text-right">
                        <a href="{{ route('administrator.film.izmena', $film -> id) }}" class="btn btn-outline-info">Izmeni</a>
                        <a href="{{ route('administrator.zaposleni.filmovi.obrisi', $film -> id) }}" class="btn btn-outline-danger">Obriši</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $filmovi -> links('partials.paginate') }}
    @else
        <div class="alert alert-warning">Trenutno ne postoje filmovi!</div>
    @endif

@stop