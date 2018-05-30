<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('home') }}">Bioskop</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item @if(strpos(Route::currentRouteName(), 'menadzer.projekcija.dodavanje') !== false) active @endif">
                <a class="nav-link" href="{{ route('menadzer.projekcija.dodavanje') }}">Dodaj film u repertoar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="dodaj_u_repertoar.html">Repetoar bioskopa</a>
            </li>
        </ul>
    </div>
</nav>