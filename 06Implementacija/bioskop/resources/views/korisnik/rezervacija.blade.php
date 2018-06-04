@extends('layouts.master')


@section('title')Rezervacija @stop

@section('content')

    <h1 class="my-2 text-center">Rezervacija</h1>
    <h4 class="text-center"> Molimo vas popunite sva polja! </h4>

    @include('partials.errors')
    @include('partials.success')
    @if($aktivne_projekcije->isNotEmpty())

    <form class="my-3" method="post" action="{{ route('rezervacija.post') }}">
        {{ csrf_field() }}
        <table class="table" width="50%" height="50%" cellpadding="10px">
            <tr>
                <td> Projekcija: </td>
                <td><select class="form-control" name="projekcija_id">
                        @if($projekcija)
                        <option value="{{ $projekcija -> id }}"> {{$projekcija -> vreme}} {{ $projekcija -> bioskop -> naziv }} - {{$projekcija->film->naziv }}</option>
                        @endif
                        @foreach($aktivne_projekcije as $proj)
                                <option value="{{ $proj -> id }}"> {{$proj -> vreme}} {{ $proj -> bioskop -> naziv }} - {{$proj->film->naziv }}</option>
                        @endforeach
                    </select></td>
            </tr>
            <tr>
                <td> Broj karata: </td>
                <td><input required class="form-control" type="number" name="brkar" placeholder="Unesite broj karata"></td>
            </tr>
            <tr>
                <td colspan=2 align=center>
                    <input class="btn btn-primary" type=submit value="Zavrseno!"></td>
            </tr>
        </table>
    </form>
    @else
        <div class="my-3 alert alert-warning">Trenutno nema aktivnih projekcija!</div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
           <table class="table-hover table">
               <tr>
                   <th>Film:</th>
                   <th>Bioskop:</th>
                   <th>Vreme:</th>
                   <th>Broj karata:</th>
                   <th></th>
               </tr>
                   @foreach($sve_rezervacije as $rez)
                   <tr>
                       <td>{{ $rez->projekcija->film->naziv }}</td>
                       <td>{{ $rez->projekcija->bioskop->naziv }}</td>
                       <td>{{ $rez->projekcija->vreme }}</td>
                       <td>{{ $rez->broj_karata }}</td>
                       <td><a href="{{route ('rezervacija.brisi', $rez)}}" class="btn btn-danger">Otkazi</a></td>
                   </tr>
                   @endforeach

           </table>
        </div>

    </div>
@stop