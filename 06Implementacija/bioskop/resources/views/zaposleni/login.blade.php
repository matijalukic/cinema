@extends('layouts.master')


@section('title')Zaposleni login @stop

@section('content')

    <h1 class="text-center my-3">Ulogujte se</h1>

    @include('partials.success')
    @include('partials.errors')

    <form method="POST" action="{{ route('zaposleni.login.post') }}">
        {{ csrf_field() }}
        <div class="form-group row justify-content-center">
            <label for="naslovfilma" class="col-sm-1 col-form-label">Username:</label>
            <div class="col-sm-3">
                <input type="text" name="username" id="username" value="{{ old('username') }}" class="form-control" placeholder="Korisnicko ime"/>
            </div>
        </div>
        <div class="form-group row justify-content-center">
            <label for="naslovfilma" class="col-sm-1 col-form-label">Password:</label>
            <div class="col-sm-3">
                <input type="password" name="password" id="password" class="form-control" placeholder="Vasa lozinka"/>
            </div>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-success">Prijava</button>
        </div>
    </form>

    <p class="text-center">
        <a href="{{ route("home") }}">Vratite se nazad</a>
        <br>
        <img src="{{ asset('img/admin.png') }}">
    </p>



@stop