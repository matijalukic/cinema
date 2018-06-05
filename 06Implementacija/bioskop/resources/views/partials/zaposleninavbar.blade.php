<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('home') }}">Bioskop</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            {{-- Administratorski linkovi --}}
            @administrator
            <li class="nav-item @if(strpos(Route::currentRouteName(), 'administrator.film.dodavanje') !== false) active @endif">
                <a class="nav-link text-warning" href="{{ route('administrator.film.dodavanje') }}">Dodaj film</a>
            </li>
            <li class="nav-item @if(strpos(Route::currentRouteName(), 'administrator.zaposleni.filmovi') !== false) active @endif" >
                <a href="{{ route('administrator.zaposleni.filmovi') }}" class="nav-link text-warning">Filmovi</a>
            </li>
            <li class="nav-item @if(strpos(Route::currentRouteName(), 'administrator.bioskop.dodavanje') !== false) active @endif">
                <a href="{{ route('administrator.bioskop.dodavanje') }}" class="nav-link text-warning">Dodaj bioskop</a>
            </li>
            <li class="nav-item @if(strpos(Route::currentRouteName(), 'administrator.bioskopi') !== false) active @endif">
                <a href="{{ route("administrator.bioskopi") }}" class="nav-link text-warning">Bioskopi</a>
            </li>
            <li class="nav-item @if(strpos(Route::currentRouteName(), 'administrator.zaposleni.brisisve') !== false) active @endif">
                <a href="{{ route('administrator.zaposleni.brisisve') }}" class="nav-link text-warning">Obriši zastarele</a>
            </li>
            <li class="nav-item @if(Route::currentRouteName() == 'administrator.zaposleni.brisi') active @endif">
                <a href="{{ route('administrator.zaposleni.brisi') }}" class="nav-link text-warning">Obriši naloge</a>
            </li>
            <li class="nav-item @if(Route::currentRouteName() == 'administrator.kreirajnalog') active @endif">
                <a href="{{ route('administrator.kreirajnalog') }}" class="nav-link text-warning">Dodaj nalog</a>
            </li>
            @endadministrator

            {{-- Menadzerski Linkovi --}}
            @menadzer
            <li class="nav-item @if(strpos(Route::currentRouteName(), 'menadzer.projekcija.dodavanje') !== false) active @endif">
                <a class="nav-link text-white" href="{{ route('menadzer.projekcija.dodavanje') }}">Dodaj projekciju</a>
            </li>
            <li class="nav-item @if(strpos(Route::currentRouteName(), 'menadzer.projekcije') !== false) active @endif">
                <a class="nav-link text-white" href="{{ route('menadzer.projekcije') }}">Projekcije bioskopa</a>
            </li>
            @endmenadzer

            {{-- Salterski Sluzbenik linkovi --}}
            @sluzbenik
                <li class="nav-item @if(Route::currentRouteName()== 'karte') active @endif">
                    <a class="nav-link text-warning" href="{{ route('karte') }}">Prodaja karata</a>
                </li>
            @endsluzbenik

        </ul>

        <ul class="navbar-nav">

            @ulogovan
                {{-- Ulogovan kao obican korisnik --}}
                @korisnik
                    <li class="nav-item text-white">
                        <a class="nav-link disabled text-white">Zdravo, {{ auth('korisnici') -> user() -> username }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('korisnik.logout') }}">Odjavi se</a>
                    </li>
                @endkorisnik

                @zaposleni
                    <li class="nav-item text-warning">
                        <a class="nav-link disabled text-warning">Zdravo, {{ auth() -> user() -> username }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('zaposleni.logout') }}">Odjavi se</a>
                    </li>
                @endzaposleni


            {{-- Nisu ulogovani --}}
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('korisnik.login') }}">Prijava</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('registracija') }}">Registracija</a>
                </li>
            @endulogovan
        </ul>


    </div>
</nav>