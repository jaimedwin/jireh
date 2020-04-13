<?php

use Illuminate\Database\Seeder;
use App\Models\Tipodocumento;
use Illuminate\Support\Facades\DB;

class TipodocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipodocumento')->delete();

        Tipodocumento::insert([
            [ 'abreviatura' => 'FCC',           'descripcion' => 'Fotocopia de la cedula', 'users_id' => 1],
            [ 'abreviatura' => 'FCT',           'descripcion' => 'Fotocopia de la tarjeta', 'users_id' => 1],
            [ 'abreviatura' => 'PDRF',    'descripcion' => 'Poder de la fuerza', 'users_id' => 1],
            [ 'abreviatura' => 'PDRC',      'descripcion' => 'Poder de la caja', 'users_id' => 1]
        ]);
    }
}
