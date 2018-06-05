<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FilmoviSeeder::class);
        $this->call(BioskopSeeder::class);
        $this->call(ZaposleniSeeder::class);
        $this->call(KorisnikSeeder::class);
        $this->call(ProjekcijeSeeder::class);
    }
}
