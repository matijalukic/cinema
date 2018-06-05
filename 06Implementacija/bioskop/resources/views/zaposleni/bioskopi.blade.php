@extends('layouts.zaposleni')


@section('title')Bioskopi @stop

@section('content')

    <h1 class="text-center my-3">Bioskopi</h1>

    @include('partials.success')
    @include('partials.errors')

    @if($bioskopi -> isNotEmpty())
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Ime</th>
                <th scope="col">Adresa</th>
                <th scope="col">Broj projekcija</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($bioskopi as $bioskop)
                <tr>
                    <th>{{ $bioskop -> naziv }}</th>
                    <td>{{ $bioskop -> adresa  }}</td>
                    <td class="text-right">{{ count($bioskop -> projekcije)}}</td>
                    <td class="text-right">
                        <a href="{{ route('administrator.bioskop.obrisi', $bioskop -> id) }}" class="btn btn-outline-danger">Obriši</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $bioskopi -> links('partials.paginate') }}
    @else
        <div class="alert alert-warning">Trenutno ne postoje bioskopi!</div>
    @endif

@stop