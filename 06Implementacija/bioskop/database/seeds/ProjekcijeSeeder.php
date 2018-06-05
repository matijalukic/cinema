<?php

use Illuminate\Database\Seeder;

class ProjekcijeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Bioskop::all() as $bioskop){

            foreach (\App\Film::all() as $film) {
                $brojDana = rand(15,20);

                $satnica = rand(17,23);
                $minuti = rand(0, 59);
                $vreme = \Carbon\Carbon::now() -> subDays(3) -> setTime($satnica, $minuti);
                $krajVreme = \Carbon\Carbon::now() -> addDays($brojDana - 3);
                for(; $vreme < $krajVreme; $vreme -> addDay()) {
                    $novaProjekcija = new \App\Projekcija;
                    $novaProjekcija->film_id = $film->id;
                    $novaProjekcija->zaposleni_id = \App\Zaposleni::where('bioskop_id', $bioskop->id)->first()->id;
                    $novaProjekcija->bioskop_id = $bioskop->id;
                    $novaProjekcija->broj_sale = rand(1, 10);
                    $novaProjekcija->vreme = $vreme -> toDateTimeString();
                    $novaProjekcija -> broj_mesta = 100;
                    $novaProjekcija -> cena = 200;
                    $novaProjekcija->save();
                }
            }
        }
    }
}
