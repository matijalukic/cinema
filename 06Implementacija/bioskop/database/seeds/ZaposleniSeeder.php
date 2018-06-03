<?php

use Illuminate\Database\Seeder;

class ZaposleniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // main admin
        \App\Zaposleni::create([
           'username' => 'admin',
           'password' => '$2y$10$aL1jS2WnQ7R/SsKSjoufHecJmG474616LR6mNkT0VOHkU7I4U7Mj6', // sifra
           'ime' => 'Nikola',
           'prezime' => 'Zlatic',
           'jmbg' => '12313544',
           'created_at' => \Carbon\Carbon::now(),
           'updated_at' => \Carbon\Carbon::now(),
        ]);
        // make him admin
        \App\Administrator::create([
            'id' => \App\Zaposleni::where('username', 'admin') -> first() -> id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        $usernames = ['luka014', 'matijalukic', 'nikolazlatic', 'alexmijusko', 'moglimogli', 'milosforman', 'lule', 'mile_pegla'];

        // za svaki bioskop moramo imati menadzera i sluzbenika, ukupno osam zaposlenih
        foreach (\App\Bioskop::all() as $bioskop){
            $zaposleni = \App\Zaposleni::create([
                'username' => array_pop($usernames),
                'password' => '$2y$10$aL1jS2WnQ7R/SsKSjoufHecJmG474616LR6mNkT0VOHkU7I4U7Mj6', // "sifra" - hashed
                'ime' => $bioskop -> naziv,
                'prezime' => 'Menadzer',
                'jmbg' => '12313544',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
            // make him menadzer
            \App\Menadzer::create([
                'id' => $zaposleni -> id,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            // napravi sluzbenika
            $zaposleni = \App\Zaposleni::create([
                'username' => array_pop($usernames),
                'password' => '$2y$10$aL1jS2WnQ7R/SsKSjoufHecJmG474616LR6mNkT0VOHkU7I4U7Mj6', // "sifra" - hashed
                'ime' => $bioskop -> naziv,
                'prezime' => 'Sluzbenik',
                'jmbg' => '12313544',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
            // make him menadzer
            \App\SalterskiSluzbenik::create([
                'id' => $zaposleni -> id,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
