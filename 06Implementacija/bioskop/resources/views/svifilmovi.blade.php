@extends('layouts.master')


@section('title')Lista Svih Filmova @stop

@section('content')
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

		
	<style>		
		
	.column {
		float: left;
		font-family: "Times New Roman", Times, serif;
		font-size: 20px;
		font-weight: bold;
	}
		
	.column1 {
		float: left;
		font-style: oblique;
	}
		
	.row:after {
		content: "";
		display: table;
		clear: both;
	}
		
	.media {			
		float:left;
	}
		
	.mr-3 {
		height75px;
		width:75px;
	}
		
	td {
		padding: 0.5em;
		padding-right: 1em;
	}
	
	</style>

	

	<form action="{{ route('filmovi.svi') }}">
		{{csrf_field()}}
	<div class="form-group row">
				<label for="datum" class="col-sm-2 col-form-label">Datum prikazivanja</label>
				<div class="col-sm-10">
					<input type="date" @if(isset($datum)) value="{{$datum}}" @endif class="form-control" id="datum" name="datum">
				</div>
        </div>
			<div class="form-group row">
				<div class="col-sm-10">
					<button type="submit" class="btn btn-success">PRIKAZI SVE FILMOVE</button>
				</div>
			</div>
	</form>
	

		@if(isset($datum))
	<div>
	
		<h1>Svi Filmovi za Odabrani Datum:</h1>
	<table>
	@foreach($bioskopi as $bioskop)
	<tr>
		<td> <li><h3>{{ $bioskop -> naziv }}&nbsp-&nbsp<i>{{$bioskop->adresa}}</i> : </h3></li></td>
	</tr>
	<tr>
		@for($x = 0; $x < 3 ; $x++)
		<td> 
					<div class="media">
					<img class="mr-3" src="film.jpg" alt="Generic placeholder image">
					<div class="media-body">
					<h5 class="mt-0">Film<?php echo $x+1 ?></h5> 
					Datum i Vreme Prikazivanja
			</div>
			</div>
		</td>
		<td>
		&nbsp
			<div class="form-group row" style= "float:left">
					<div class="col-sm-10">
					<button type="submit" class="btn btn-primary">Rezervisi</button>
					</div>
			</div>
		</td>
		@endfor
	</tr>
	@endforeach
</table>
	</div
	@endif
	
	
@stop