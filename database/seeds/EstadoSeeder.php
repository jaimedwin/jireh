<?php

use Illuminate\Database\Seeder;
use App\Estado;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::insert([
            [ 'descripcion' => 'ADMITIDA', 'users_id' => 1],
            [ 'descripcion' => 'APELADA', 'users_id' => 1],
            [ 'descripcion' => 'CON RECURSO', 'users_id' => 1],
            [ 'descripcion' => 'INADMITIDA', 'users_id' => 1]
        ]);
    }

}
