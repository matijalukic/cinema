@extends('layouts.master')


@section('title') 
Filmovi
@stop

@section('content')

<h1>{{ $title }}</h1>

<ul>
	@for($i = 0; $i < $broj; $i++)
		<li>{{ $film[$i] }}</li>
	@endfor
</ul>

	Zlajo je {{ $zlajo }}

@stop