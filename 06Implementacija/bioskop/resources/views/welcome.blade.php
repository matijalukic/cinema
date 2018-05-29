@extends('layouts.master')


@section('title')Svi bioskopi @stop

@section('content')

	<h1>Bioskopi</h1>


	<h3>Filmovi:</h3>
	<ul>
		@foreach($filmovi as $film)
			<li>{{ $film -> naziv }}</li>
		@endforeach

	</ul>
@stop