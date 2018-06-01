@extends('layouts.zaposleni')


@section('title')Kreiranje korisnika @stop

@section('content')

    @include('partials.errors')
    @include('partials.success')

    <form method="post" action="{{ route("administrator.kreirajnalog.post") }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group row">
            <label for="ime" class="col-sm-2 col-form-label">Ime</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="ime" id="ime" placeholder="">
            </div>
        </div>
        <div class="form-group row">
            <label for="prezime" class="col-sm-2 col-form-label">Prezime</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="prezime" id="prezime" placeholder="">
            </div>
        </div>
        <div class="form-group row">
            <label for="jmbg" class="col-sm-2 col-form-label">Jmbg</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="jmbg" id="jmbg" placeholder="">
            </div>
        </div>
        <div class="form-group row">
            <label for="username" class="col-sm-2 col-form-label">Korisnicko ime</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="username" id="username" placeholder="">
            </div>
        </div>
        <div class="form-group row">
            <label for="pass" class="col-sm-2 col-form-label">Lozinka</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="password" id="lozinka1" placeholder="">
            </div>
        </div>
        <div class="form-group row">
            <label for="passconf" class="col-sm-2 col-form-label">Ponovite lozinku</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="password_confirmation" id="lozinka2" placeholder="">
            </div>
        </div>
        <div class="form-group row">
            <label for="tip" class="col-sm-2 col-form-label">Tip naloga</label>
            <div class="col-sm-10">
                <select id="inputState" name="tip" class="form-control">
                    <option value="Sluzbenik">Sluzbenik</option>
                    <option value="Menadzer">Menadzer</option>
                    <option value="Administrator">Administrator</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="bioskop" class="col-sm-2 col-form-label">Bioskop</label>
            <div class="col-sm-10">
                <select id="inputState" name="bioskop" class="form-control">
                    <option value="">---Bez bioskopa---</option>
                    @foreach($bioskopi as $bioskop)
                        <option value="{{$bioskop->id}}">{{$bioskop->id}}: {{$bioskop->naziv}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 text-center">
                <button type="submit" class="btn btn-primary">Kreiraj nalog</button>
            </div>
        </div>
    </form>
@stop