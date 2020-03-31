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
        DB::table('fondodepension')->delete();

        Fondodepension::insert([
            ['abreviatura' => 'Casur', 'descripcion' => 'Caja de Sueldos de Retiro de la Policía Nacional', 'users_id' => 1],
            ['abreviatura' => 'Cremil', 'descripcion' => 'Caja de Retiro de las Fuerzas Militares', 'users_id' => 1],
            ['abreviatura' => 'Tegen', 'descripcion' => 'Tesorería General', 'users_id' => 1],
            ['abreviatura' => 'Minde', 'descripcion' => '', 'users_id' => 1],
            ['abreviatura' => 'NA', 'descripcion' => 'No aplica', 'users_id' => 1],
        ]);
    }
}
