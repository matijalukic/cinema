<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('home') }}">Bioskop</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link @if(Route::currentRouteName()== 'home') active @endif" href="{{ route('home') }}">Lista bioskopa <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(Route::currentRouteName()== 'filmovi') active @endif" href="{{ route("filmovi") }}">Filmovi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(Route::currentRouteName()== 'projekcije') active @endif" href="{{ route("projekcije") }}" href="{{ route('projekcije') }}">Pretraga projekcija</a>
            </li>
        </ul>


        <ul class="navbar-nav">

            @ulogovan
                {{-- Ulogovan kao obican korisnik --}}
                @korisnik
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('rezervacija') }}">Rezervacija</a>
                    </li>
                    <li class="nav-item text-white">
                        <a class="nav-link disabled text-white">Zdravo, {{ auth('korisnici') -> user() -> username }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('korisnik.logout') }}">Odjavi se</a>
                    </li>
                @endkorisnik

                @sluzbenik

                    <li class="nav-item @if(Route::currentRouteName()== 'karte') active @endif">
                        <a class="nav-link text-warning" href="{{ route('karte') }}">Prodaja karata</a>
                    </li>

                @endsluzbenik

                @zaposleni

                    <li class="nav-item text-warning">
                        <a href="{{ route('zaposleni.index') }}" class="nav-link disabled text-warning">Zdravo, {{ auth() -> user() -> username }}</a>
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
