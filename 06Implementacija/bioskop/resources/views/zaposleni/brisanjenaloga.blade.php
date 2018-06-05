@extends('layouts.zaposleni')


@section('title')Brisanje naloga - rucno @stop

@section('content')

    @include('partials.success')
    @include('partials.errors')

    <form method="post" action="{{ route("administrator.zaposleni.brisi.post") }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group row justify-content-center">
            <label for="zaposleni" class="col-sm-2 col-form-label">Username zaposlenog</label>
            <div class="col-sm-10">
                <select multiple class="form-control" name="zaposlen[]" id="exampleFormControlSelect2" size="5">
                    @foreach($zaposleni as $zaposlen)
                        <option value="{{$zaposlen->id}}">{{$zaposlen->ime}} {{$zaposlen->prezime}} - {{$zaposlen->username}} - Poslednje koriscen: {{$zaposlen->updated_at}}</option>
                    @endforeach

                </select>
            </div>
        </div>
        <div class="form-group row" justify-content-center>
            <label for="korisnici" class="col-sm-2 col-form-label">Username korisnika</label>
            <div class="col-sm-10">
                <select multiple class="form-control" name="korisnik[]" id="exampleFormControlSelect2" size="7">
                    @foreach($korisnici as $korisnik)
                        <option value="{{$korisnik->id}}">{{$korisnik->ime}} {{$korisnik->prezime}} - {{$korisnik->username}} - Poslednje koriscen: {{$korisnik->updated_at}}</option>
                    @endforeach

                </select>
            </div>
        </div>
        <div class="form-group row justify-content-center">
            <div class="col-sm-10 text-center">
                <button type="submit" class="btn btn-danger">Obrisi</button>
            </div>
        </div>
    </form>

@stop