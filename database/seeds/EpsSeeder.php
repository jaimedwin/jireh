<?php

use Illuminate\Database\Seeder;
use App\Models\Eps;
use Illuminate\Support\Facades\DB;

class EpsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('eps')->truncate();

        Eps::insert([
            ['abreviatura' => 'DISAN',              'descripcion' => 'Dirección de Sanidad de la Policía Nacional ', 'users_id' => 1],
            ['abreviatura' => 'DIGSA',              'descripcion' => 'Dirección sanidad militar', 'users_id' => 1],
            ['abreviatura' => 'EPS SURA',           'descripcion' => '', 'users_id' => 1],
            ['abreviatura' => 'ALIANSALUD EPS',     'descripcion' => '', 'users_id' => 1],
            ['abreviatura' => 'EPS SANITAS',        'descripcion' => '', 'users_id' => 1],
            ['abreviatura' => 'COMPENSAR EPS',      'descripcion' => '', 'users_id' => 1],
            ['abreviatura' => 'SALUD TOTAL',        'descripcion' => '', 'users_id' => 1],
            ['abreviatura' => 'NUEVA EPS',          'descripcion' => '', 'users_id' => 1],
            ['abreviatura' => 'COOMEVA EPS',        'descripcion' => '', 'users_id' => 1],
            ['abreviatura' => 'FAMISANAR',          'descripcion' => '', 'users_id' => 1],
            ['abreviatura' => 'COMFENALCO VALLE',    'descripcion' => '', 'users_id' => 1],
            ['abreviatura' => 'SALUDVIDA',          'descripcion' => '', 'users_id' => 1],
            ['abreviatura' => 'CRUZ BLANCA',        'descripcion' => '', 'users_id' => 1],
            ['abreviatura' => 'CAFASALUD',          'descripcion' => '', 'users_id' => 1],
            ['abreviatura' => 'NA',                 'descripcion' => 'No aplica', 'users_id' => 1],
        ]);
    }
}
