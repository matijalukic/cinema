<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('home') }}">Bioskop</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item @if(strpos(Route::currentRouteName(), 'administrator.film.dodavanje') !== false) active @endif">
                <a class="nav-link " href="{{ route('administrator.film.dodavanje') }}">Dodaj film</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="dodaj_u_repertoar.html">Dodaj film u repertoar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="izbaci_iz_repertoara.html">Izbaci iz repertoara</a>
            </li>
        </ul>

        <ul class="navbar-nav">

            @if(auth() -> check())
                <li class="nav-item text-white">
                    <a class="nav-link disabled text-white">Zdravo, {{ auth() -> user() -> username }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('zaposleni.logout') }}">Odjavi se</a>
                </li>
            {{-- Nisu ulogovani --}}
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('zaposleni.login') }}">Login</a>
                </li>
            @endif
        </ul>


    </div>
</nav>