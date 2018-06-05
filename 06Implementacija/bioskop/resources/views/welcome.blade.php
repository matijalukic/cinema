@extends('layouts.master')


@section('title')Svi Bioskopi @stop

@section('content')

	<h1 class="text-center">Naši Bioskopi</h1>


	<div class="row">


		@foreach($bioskopi as $bioskop)
			<div class="col-md-12 my-4">
				<div class="card">
					<div class="card-body">
						<a href="{{ route('bioskop', $bioskop) }}"><h4 class="card-title">{{ $bioskop -> naziv }}</h4></a>
						<h6 class="card-subtitle mb-2 text-muted">{{ $bioskop -> adresa }}</h6>

						<div class="card-group">
							@foreach($bioskop -> sledece_projekcije as $projekcija)
							<div class="card bg-dark text-white">
								<img class="card-img rounded" src="{{ asset('storage/' . $projekcija -> film -> path) }}" alt="{{ $projekcija -> film -> naziv }}">
								<div class="card-img-overlay projekcija-film">
									<h4 class="card-subtitle">{{ $projekcija -> format_vreme }}</h4>
									<a href="{{ route('film', $projekcija -> film) }}"><h5 class="card-title">{{ $projekcija -> film -> naziv }}</h5></a>
									<p class="card-text text-justify">{{ $projekcija -> film -> opis }}</p>
									<p class="card-text"><small class="text-muted">{{ $projekcija -> film -> trajanje }} min {{ $projekcija -> broj_mesta }} mesta</small></p>
									@korisnik
									<a href="{{ route('rezervacija', $projekcija) }}" class="btn btn-primary">Rezerviši</a>
									@endkorisnik
								</div>
							</div>
							@endforeach
						</div>



					</div>
				</div>


			</div>
		@endforeach

	</div>
	
@stop