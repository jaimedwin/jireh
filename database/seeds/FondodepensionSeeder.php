<?php

use Illuminate\Database\Seeder;
use App\Models\Fondodepension;
use Illuminate\Support\Facades\DB;

class FondodepensionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fondodepension')->truncate();

        Fondodepension::insert([
            ['abreviatura' => 'CASUR', 'descripcion' => 'Caja de Sueldos de Retiro de la Policía Nacional', 'users_id' => 1],
            ['abreviatura' => 'CREMIL', 'descripcion' => 'Caja de Retiro de las Fuerzas Militares', 'users_id' => 1],
            ['abreviatura' => 'TEGEN', 'descripcion' => 'Tesorería General Policía Nacional', 'users_id' => 1],
            ['abreviatura' => 'MINDE', 'descripcion' => 'Tesorería ministerio de defensa', 'users_id' => 1],
            ['abreviatura' => 'NA', 'descripcion' => 'No aplica', 'users_id' => 1],
        ]);
    }
}
