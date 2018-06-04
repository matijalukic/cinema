<?php

namespace App\Http\Controllers;
use App\Bioskop;
use App\Film;
use App\Http\Requests\Bioskopi\NoviBioskopRequest;
use App\Http\Requests\Filmovi\IzmenaFilmaRequest;
use App\Http\Requests\Filmovi\NoviFilmRequest;
use App\Http\Requests\zaposleni\BrisanjeNalogaRequest;
use App\Http\Requests\Zaposleni\BrisanjeSvihNalogaRequest;
use App\Http\Requests\Zaposleni\KreirajNalogRequest;
use App\Korisnik;
use App\Zaposleni;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mockery\Exception;


/**
 * Realizuje sve operacije dovoljene moderatoru
 *
 * Class AdministratorController
 * @package App\Http\Controllers
 */
class AdministratorController extends Controller
{
    public function __construct()
    {
        $this -> middleware('administrator');
    }
    
    /**
     * Prikazivanje formulara za dodavanje filma
     */
    public function dodavanjeFilma()
    {
        return view('zaposleni.dodavanjefilma');
    }

    /**
     * Prikazivanje formulara za dodavanje bioskopa
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function dodavanjeBioskopa(){
		return view('zaposleni.dodavanjebioskopa');
	}


    /**
     * Perzistiranje filma kroz request
     * @param NoviFilmRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unosFilma(NoviFilmRequest $request)
    {
        try{
            $request -> persist();
            session() -> flash('success', 'Uspešan unos filma!');
        }
        catch(\Exception $e){
            session() -> flash('error', $e -> getMessage());
        }

        return redirect() -> back();
    }

    /**
     * Perzistiranje novog bioskopa
     *
     * @param NoviBioskopRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
	public function unosBioskopa(NoviBioskopRequest $request)
    {
        try{
            $request -> persist();
            session() -> flash('success', 'Uspešan unos bioskopa!');

            return redirect() -> route('administrator.bioskopi');
        }
        catch(\Exception $e){
            session() -> flash('error', $e -> getMessage());
        }

        return redirect() -> back();
    }

    /**
     * Izmena filma za dati id
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function izmenaFilma($id)
    {
        $film = Film::findOrFail($id);

        return view('zaposleni.izmenafilma',[
            'film' => $film
        ]);
    }

    /**
     * Perzistiranje izmene filma u bazu
     *
     * @param IzmenaFilmaRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function izmenaFilmaPost(IzmenaFilmaRequest $request)
    {
        try{
            $request -> persist();
            session() -> flash('success', 'Uspešno izmenjen film!');
        }
        catch(\Exception $e){
            session() -> flash('error', $e -> getMessage());
        }
        return redirect() -> back();
    }

    public function brisiNalog()
    {
        $zaposleni = Zaposleni::all();
        $korisnici = Korisnik::all();

        return view('zaposleni.brisanjenaloga',[
            'zaposleni' => $zaposleni,
            'korisnici' => $korisnici
        ]);
    }
    public function brisiNalogPost(BrisanjeNalogaRequest $request)
    {
        try{
            $request -> persist();
            session() -> flash('success', 'Uspešno brisanje naloga!');
        }
        catch(\Exception $e){
            session() -> flash('error', $e -> getMessage());
        }
        return redirect() -> back();
    }

    public function brisiSve()
    {
        return view('zaposleni.brisanjesvihnaloga');
    }

    public function brisiSvePost(BrisanjeSvihNalogaRequest $request)
    {
        try{
            $br = $request -> persist();
            session() -> flash('success', "Uspešno ste obrisali $br zastarela naloga!");
        }
        catch(\Exception $e){
            session() -> flash('error', $e -> getMessage());
        }
        return redirect() -> back();
    }


    /**
     * Prosledjuje ka view listu svih bioskopa
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bioskopi()
    {
        $bioskopi  = Bioskop::orderByDesc('created_at') -> paginate(20);

        return view('zaposleni.bioskopi',[
            'bioskopi' => $bioskopi
        ]);
    }

    /**
     * Brise bioskop sa odredjenim $id-om
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function obrisiBioskop($id)
    {
        $bioskop = Bioskop::findOrFail($id);


        $bioskop->delete();
        session()->flash('success', 'Bioskop je obrisan!');
        return redirect() -> back();
    }

    public function kreirajNalog()
    {
        $bioskopi = Bioskop::all();
        return view('zaposleni.kreiranjenaloga',[
            'bioskopi'=>$bioskopi
        ]);
    }

    public function kreirajNalogPost(KreirajNalogRequest $request)
    {
        try{
            $request -> persist();
            session() -> flash('success', "Uspešno ste kreirali nalog!");
        }
        catch(\Exception $e){
            session() -> flash('error', $e -> getMessage());
        }

        return redirect() -> back();
    }
    public function filmovi()
    {
        $filmovi  = Film::orderByDesc('created_at') -> paginate(20);

        return view('zaposleni.filmovi',[
            'filmovi' => $filmovi
        ]);

    }


    public function obrisiFilm($id)
    {
        $film =Film::findOrFail($id);


        $film->delete();
        session()->flash('success', 'Film je obrisan!');
        return redirect() -> back();
    }
}
