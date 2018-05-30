@extends('layouts.master')


@section('title')Svi bioskopi @stop

@section('content')

	<h1>Bioskopi</h1>
		
	<ul>
		@foreach($bioskopi as $bioskop)
			<div>
				<li>{{ $bioskop -> naziv}}</li>
			</div>
		@endforeach

	</ul>
	
@stop