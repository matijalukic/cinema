@extends('layouts.master')


@section('title')Prodaja Karte @stop

@section('content')

    <h1 class="my-2 text-center">Karte</h1>


    @include('partials.errors')
    @include('partials.success')

    <h3 class="text-center">Prodaj kartu</h3>
        <form class="my-3" method="post" action="{{ route('karte.post') }}">
            {{ csrf_field() }}
            <table class="table" width="50%" height="50%" cellpadding="10px">
                <tr>
                    <td>Projekcija:</td>
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
                    <td>Korisnik:</td>
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
                        <input class="btn btn-primary" type=submit value="Zavrseno!">
                    </td>
                </tr>
            </table>
        </form>

        <h3 class="text-center">Prodaj rezervisanu kartu</h3>
        <form action="{{ route('karte.rezervacija.post') }}" class="my-3">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="rezervacija_id">Rezervacija</label>
                <select name="rezervacija_id" id="rezervacija_id" class="form-control">
                    @foreach($rezervacije as $rezervacija)
                        <option value="{{ $rezervacija -> id }}">{{ $rezervacija -> korisnik -> username }} - {{ $rezervacija -> broj_karata }} karata, {{ $rezervacija -> projekcija -> film -> naziv }} u {{ $rezervacija -> projekcija -> bioskop -> naziv }} -
                            {{ \Carbon\Carbon::parse($rezervacija -> projekcija -> vreme) -> format('H:i d.m.Y') }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Prodaj karte\u</button>
            </div>
        </form>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="text-center">Prodate karte</h3>

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

            {{ $sve_karte -> links('partials.paginate') }}
        </div>

    </div>
@stop