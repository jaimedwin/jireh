<?php

use Illuminate\Database\Seeder;
use App\Models\Tipodemanda;
use Illuminate\Support\Facades\DB;

class TipodemandaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipodemanda')->delete();

        Tipodemanda::insert([
            [ 'abreviatura' => 'NS1',           'descripcion' => 'Nivelación salarial 1', 'users_id' => 1],
            [ 'abreviatura' => 'NS2',           'descripcion' => 'Nivelación salarial 2', 'users_id' => 1],
            [ 'abreviatura' => 'AS',            'descripcion' => 'Ajuste salarial', 'users_id' => 1],
        ]);
    }
}
