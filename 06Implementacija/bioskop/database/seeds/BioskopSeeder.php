<?php

use Illuminate\Database\Seeder;

class BioskopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Bioskop::create([
            'naziv' => 'Cineplexx Big',
            'adresa' => 'Visnjicka',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        \App\Bioskop::create([
            'naziv' => 'Cineplexx Delta',
            'adresa' => 'Jurija Gagarina 14',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        \App\Bioskop::create([
            'naziv' => 'Cineplexx Usce',
            'adresa' => 'Bulevar Mihajla Pupina 4',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        \App\Bioskop::create([
            'naziv' => 'Kombank dvorana',
            'adresa' => 'Dečanska 14',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
