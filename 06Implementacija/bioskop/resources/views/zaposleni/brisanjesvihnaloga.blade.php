@extends('layouts.zaposleni')


@section('title')Brisanje naloga - rucno @stop

@section('content')

    @include('partials.success')
    @include('partials.errors')

    <form method="post" action="{{ route("administrator.zaposleni.brisisve.post") }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group row">
            <label for="dana" class="col-sm-4 col-form-label">Obrisi sve naloge ukoliko nisu bili aktivni:</label>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <div class="input-group mb-2">

                    <input type="text" class="form-control" name="dana" id="dana" placeholder="'10','365'...">
                    <div class="input-group-append">
                        <div class="input-group-text">dana</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 text-center">
                <button type="submit" class="btn btn-danger">Obrisi</button>
            </div>
        </div>
    </form>

@stop