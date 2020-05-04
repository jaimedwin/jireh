<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsultacorreoTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('consultacorreotipo')->truncate();

        DB::table('consultacorreotipo')->insert([
            ['id' => 1,'descripcion' => 'Solicitud cambio de contraseña'],
            ['id' => 2, 'descripcion' => 'Notificación actuaciones del proceso']
        ]);
    }
}
