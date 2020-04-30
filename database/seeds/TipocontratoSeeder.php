<?php

use Illuminate\Database\Seeder;
use App\Models\Tipocontrato;
use Illuminate\Support\Facades\DB;

class TipocontratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipocontrato')->truncate();

        Tipocontrato::insert([
            [ 'descripcion' => 'Mixto', 'users_id' => 1],
            [ 'descripcion' => 'Honorario monetario', 'users_id' => 1],
            [ 'descripcion' => 'Honorario porcentual', 'users_id' => 1],
        ]);
    }
}
