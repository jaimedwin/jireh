<?php

use Illuminate\Database\Seeder;
use App\Models\Corporacion;
use Illuminate\Support\Facades\DB;

class CorporacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('corporacion')->delete();

        Corporacion::insert([
            [ 'nombre' => 'CONSEJO DE ESTADO', 'correonotificacion' => '', 'users_id' => 1],
            [ 'nombre' => 'JUZGADO', 'correonotificacion' => '', 'users_id' => 1],
            [ 'nombre' => 'TRIBUNAL', 'correonotificacion' => '', 'users_id' => 1],
        ]);
    }
}
