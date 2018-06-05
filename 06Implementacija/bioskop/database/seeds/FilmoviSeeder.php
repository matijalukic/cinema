<?php

use Illuminate\Database\Seeder;

class FilmoviSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // American gangster
        \App\Film::create([
            'naziv' => 'American Gangster',
            'zanr' => 'Drama,Kriminal',
            'trajanje' => '157',
            'godina' => '2007',
            'opis' => 'An outcast New York City cop is charged with bringing down Harlem drug lord Frank Lucas, whose real life inspired this partly biographical film.',
            'reziser' => 'Ridley Scott',
            'path' => 'filmovi/american_gangster.jpg',
            'glavna_uloga' => 'Denzel Washington, Russell Crowe, Chiwetel Ejiofor',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        // Catch me if you can
        \App\Film::create([
            'naziv' => 'Catch Me If You Can',
            'zanr' => 'Drama,Kriminal',
            'trajanje' => '141',
            'godina' => '2002',
            'opis' => 'A seasoned FBI agent pursues Frank Abagnale Jr. who, before his 19th birthday, successfully forged millions of dollars\' worth of checks while posing as a Pan Am pilot, a doctor, and a legal prosecutor.',
            'reziser' => 'Steven Spielberg',
            'path' => 'filmovi/catch_me.jpg',
            'glavna_uloga' => 'Leonardo DiCaprio, Tom Hanks, Christopher Walken',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        // Inception
        \App\Film::create([
            'naziv' => 'Inception',
            'zanr' => 'Akcija,Avantura',
            'trajanje' => '148',
            'godina' => '2010',
            'opis' => 'A thief, who steals corporate secrets through the use of dream-sharing technology, is given the inverse task of planting an idea into the mind of a CEO.',
            'reziser' => 'Christopher Nolan',
            'path' => 'filmovi/inception.jpg',
            'glavna_uloga' => ' Leonardo DiCaprio, Joseph Gordon-Levitt, Ellen Page',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        // Interstellar
        \App\Film::create([
            'naziv' => 'Interstellar',
            'zanr' => 'Avantura,Drama',
            'trajanje' => '169',
            'godina' => '2014',
            'opis' => 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity\'s survival.',
            'reziser' => 'Christopher Nolan',
            'path' => 'filmovi/interstellar.jpg',
            'glavna_uloga' => 'Matthew McConaughey, Anne Hathaway, Jessica Chastain',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        // Seven
        \App\Film::create([
            'naziv' => 'Se7en',
            'zanr' => 'Drama,Kriminal',
            'trajanje' => '127',
            'godina' => '1995',
            'opis' => 'Two detectives, a rookie and a veteran, hunt a serial killer who uses the seven deadly sins as his motives.',
            'reziser' => 'David Fincher',
            'path' => 'filmovi/seven.jpg',
            'glavna_uloga' => 'Morgan Freeman, Brad Pitt, Kevin Spacey',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        // Devils advocate
        \App\Film::create([
            'naziv' => 'The Devil\'s Advocate',
            'zanr' => 'Drama,Kriminal',
            'trajanje' => '144',
            'godina' => '1997',
            'opis' => 'An exceptionally adept Florida lawyer is offered a job to work in New York City for a high-end law firm with a high-end boss - the biggest opportunity of his career to date.',
            'reziser' => 'Taylor Hackford',
            'path' => 'filmovi/thedevilsadvocate.jpg',
            'glavna_uloga' => 'Keanu Reeves, Al Pacino, Charlize Theron',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
