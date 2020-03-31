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
        DB::table('eps')->delete();

        Eps::insert([
            ['abreviatura' => 'EPS Sura',                       'descripcion' => '', 'users_id' => 1],
            ['abreviatura' => 'Aliansalud',                     'descripcion' => '', 'users_id' => 1],
            ['abreviatura' => 'Sanitas',                        'descripcion' => '', 'users_id' => 1],
            ['abreviatura' => 'Compensar EPS',                  'descripcion' => '', 'users_id' => 1],
            ['abreviatura' => 'Salud Total',                    'descripcion' => '', 'users_id' => 1],
            ['abreviatura' => 'Nueva EPS',                      'descripcion' => '', 'users_id' => 1],
            ['abreviatura' => 'Coomeva EPS',                    'descripcion' => '', 'users_id' => 1],
            ['abreviatura' => 'Famisanar',                      'descripcion' => '', 'users_id' => 1],
            ['abreviatura' => 'Comfenalco Valle',               'descripcion' => '', 'users_id' => 1],
            ['abreviatura' => 'SaludVida',                      'descripcion' => '', 'users_id' => 1],
            ['abreviatura' => 'Cruz Blanca',                    'descripcion' => '', 'users_id' => 1],
            ['abreviatura' => 'Cafesalud',                      'descripcion' => '', 'users_id' => 1],
            ['abreviatura' => 'NA',                             'descripcion' => 'No aplica', 'users_id' => 1],
        ]);
    }
}
