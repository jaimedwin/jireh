<?php

use Illuminate\Database\Seeder;
use App\Ciudadproceso;

class CiudadprocesoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ciudadproceso::insert([
            ['nombre' => 'BARRANQUILLA', 'users_id' => 1],
            ['nombre' => 'BOGOTÁ D.C.', 'users_id' => 1],
            ['nombre' => 'BUGA', 'users_id' => 1],
            ['nombre' => 'CALI', 'users_id' => 1],
            ['nombre' => 'CUCUTA', 'users_id' => 1],
            ['nombre' => 'GIRARDOT', 'users_id' => 1],
            ['nombre' => 'IBAGUÉ', 'users_id' => 1],
            ['nombre' => 'MANIZALES', 'users_id' => 1],
            ['nombre' => 'MEDELLÍN', 'users_id' => 1],
            ['nombre' => 'NEIVA', 'users_id' => 1],
            ['nombre' => 'PASTO', 'users_id' => 1],
            ['nombre' => 'PEREIRA', 'users_id' => 1],
            ['nombre' => 'POPAYAN', 'users_id' => 1],
            ['nombre' => 'RIOHACHA', 'users_id' => 1],
            ['nombre' => 'SAN ANDRES', 'users_id' => 1],
            ['nombre' => 'SINCELEJO', 'users_id' => 1],
            ['nombre' => 'TUNJA', 'users_id' => 1],
            ['nombre' => 'VALLEDUPAR', 'users_id' => 1],
            ['nombre' => 'VILLAVICENCIO', 'users_id' => 1]
        ]);
    }
}
