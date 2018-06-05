@extends('layouts.zaposleni')


@section('title')Dashboard @stop

@section('content')

    <h1 class="text-center my-3">Dobrodošao {{ auth() -> user() -> ime}}</h1>

    @include('partials.success')
    @include('partials.errors')

    <p class="lead">Izaberite akciju u gornjem meniju.</p>

@stop