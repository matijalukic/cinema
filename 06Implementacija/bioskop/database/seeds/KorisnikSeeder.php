<?php

use Illuminate\Database\Seeder;

class KorisnikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $korisnici = ['pera', 'mika', 'laza', 'matija', 'mijusko', 'mile', 'lule', 'zlaky', 'milos'];

        foreach ($korisnici as $korisnik){
            \App\Korisnik::create([
                'username' => $korisnik,
                'ime' => $korisnik,
                'email' => $korisnik . '@gmail.com',
                'prezime' => $korisnik . 'ic',
                'broj' => '06' . rand(10000000, 99999999),
                'jmbg' => rand(111111111,9999999),
                'adresa' => $korisnik . ' 05/05',
                'password' => '$2y$10$aL1jS2WnQ7R/SsKSjoufHecJmG474616LR6mNkT0VOHkU7I4U7Mj6',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

        }
    }
}
