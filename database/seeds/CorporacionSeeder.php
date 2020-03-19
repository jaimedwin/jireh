<?php

use Illuminate\Database\Seeder;
use App\Corporacion;

class CorporacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Corporacion::insert([
            [ 'nombre' => 'CONSEJO DE ESTADO', 'correonotificacion' => '', 'users_id' => 1],
            [ 'nombre' => 'JUZGADO', 'correonotificacion' => '', 'users_id' => 1],
            [ 'nombre' => 'TRIBUNAL', 'correonotificacion' => '', 'users_id' => 1],
        ]);
    }
}
