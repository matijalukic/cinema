@extends('layouts.zaposleni')


@section('title')Nemate dozvolu @stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center text-danger my-4">Greška</h2>
            <p class="lead text-center">Nemate dozvolu pristupiti ovoj stranici!</p>

            <img src="{{ asset('img/hasnopowerhere.jpg') }}" alt="Has no power here" class="img-fluid my-5">
        </div>
    </div>
@stop