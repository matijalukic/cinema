@extends('layouts.master')


@section('title')Prodaja Karte @stop

@section('content')

    <h1 class="my-2 text-center">Karte</h1>
    <h4 class="text-center"> Molimo vas popunite sva polja!</h4>

    @include('partials.errors')
    @include('partials.success')
        <form class="my-3" method="post" action="{{ route('karte.post') }}">
            {{ csrf_field() }}
            <table class="table" width="50%" height="50%" cellpadding="10px">
                <tr>
                    <td> Projekcija: </td>
                    <td><select class="form-control" name="projekcija_id">
                            @if($projekcija)
                                <option value="{{ $projekcija -> id }}"> {{$projekcija -> vreme}} {{ $projekcija -> bioskop -> naziv }} - {{$projekcija->film->naziv }}</option>
                            @endif
                            @foreach($sve_projekcije as $proj)
                                <option value="{{ $proj -> id }}"> {{$proj -> vreme}} {{ $proj -> bioskop -> naziv }} - {{$proj->film->naziv }}</option>
                            @endforeach
                        </select></td>
                </tr>
                <tr>
                    <td> Korisnik: </td>
                    <td><select class="form-control" name="korisnik_id">
                            @if($korisnik)
                                <option value="{{ $korisnik -> id }}"> {{$korisnik -> username}} [{{ $korisnik -> ime }}  {{$korisnik-> prezime }}]</option>
                            @endif
                            @foreach($svi_korisnici as $kor)
                                <option value="{{ $kor -> id }}">{{$kor -> username}} [{{ $kor -> ime }}  {{$kor-> prezime }}]</option>
                            @endforeach
                        </select></td>
                </tr>
                <tr>
                    <td colspan=2 align=center>
                        <input class="btn btn-primary" type=submit value="Zavrseno!"></td>
                </tr>
            </table>
        </form>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table-hover table">
                <tr>
                    <th>Film:</th>
                    <th>Bioskop:</th>
                    <th>Vreme:</th>
                    <th>Korisnik:</th>
                    <th></th>
                </tr>
                @foreach($sve_karte as $karta)
                    <tr>
                        <td>{{ $karta->projekcija->film->naziv }}</td>
                        <td>{{ $karta->projekcija->bioskop->naziv }}</td>
                        <td>{{ $karta->projekcija->vreme }}</td>
                        <td>{{ $karta->korisnik->username }}</td>
                    </tr>
                @endforeach

            </table>
        </div>

    </div>
@stop