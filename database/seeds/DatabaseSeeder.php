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
        // $this->call(UsersTableSeeder::class);
        //$this->call(CorporacionSeeder::class);
        $this->call(CiudadprocesoSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(PonenteSeeder::class);
        $this->call(TipodocumentoidentificacionSeeder::class);   
    }
}
