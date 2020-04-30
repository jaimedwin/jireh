<?php

use Illuminate\Database\Seeder;
use App\Models\Departamento;
use Illuminate\Support\Facades\DB;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departamento')->truncate();

        Departamento::insert([
            ['id' => '5',    'nombre' => 'Antioquia', 'users_id' => 1],
            ['id' => '68',    'nombre' => 'Santander', 'users_id' => 1],
            ['id' => '70',    'nombre' => 'Sucre', 'users_id' => 1],
            ['id' => '85',    'nombre' => 'Casanare', 'users_id' => 1],
            ['id' => '54',    'nombre' => 'Norte de Santander', 'users_id' => 1],
            ['id' => '25',    'nombre' => 'Cundinamarca', 'users_id' => 1],
            ['id' => '97',    'nombre' => 'Vaupés', 'users_id' => 1],
            ['id' => '23',    'nombre' => 'Córdoba', 'users_id' => 1],
            ['id' => '86',    'nombre' => 'Putumayo', 'users_id' => 1],
            ['id' => '52',    'nombre' => 'Nariño', 'users_id' => 1],
            ['id' => '8',    'nombre' => 'Atlántico', 'users_id' => 1],
            ['id' => '13',    'nombre' => 'Bolívar', 'users_id' => 1],
            ['id' => '76',    'nombre' => 'Valle del Cauca', 'users_id' => 1],
            ['id' => '73',    'nombre' => 'Tolima', 'users_id' => 1],
            ['id' => '18',    'nombre' => 'Caquetá', 'users_id' => 1],
            ['id' => '91',    'nombre' => 'Amazonas', 'users_id' => 1],
            ['id' => '15',    'nombre' => 'Boyacá', 'users_id' => 1],
            ['id' => '19',    'nombre' => 'Cauca', 'users_id' => 1],
            ['id' => '27',    'nombre' => 'Chocó', 'users_id' => 1],
            ['id' => '17',    'nombre' => 'Caldas', 'users_id' => 1],
            ['id' => '47',    'nombre' => 'Magdalena', 'users_id' => 1],
            ['id' => '20',    'nombre' => 'Cesar', 'users_id' => 1],
            ['id' => '63',    'nombre' => 'Quindío', 'users_id' => 1],
            ['id' => '50',    'nombre' => 'Meta', 'users_id' => 1],
            ['id' => '41',    'nombre' => 'Huila', 'users_id' => 1],
            ['id' => '44',    'nombre' => 'La Guajira', 'users_id' => 1],
            ['id' => '66',    'nombre' => 'Risaralda', 'users_id' => 1],
            ['id' => '81',    'nombre' => 'Arauca', 'users_id' => 1],
            ['id' => '94',    'nombre' => 'Guainía', 'users_id' => 1],
            ['id' => '99',    'nombre' => 'Vichada', 'users_id' => 1],
            ['id' => '95',    'nombre' => 'Guaviare', 'users_id' => 1],
            ['id' => '88',    'nombre' => 'Archipiélago de San Andrés, Providencia y Santa Catalina', 'users_id' => 1],
            ['id' => '11',    'nombre' => 'Bogotá D.C.', 'users_id' => 1],
        ]);
    }
}
