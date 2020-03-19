<?php

use Illuminate\Database\Seeder;
use App\Tipodocumentoidentificacion;

class TipodocumentoidentificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Tipodocumentoidentificacion::insert([
            [ 'abreviatura' => 'RC', 'descripcion' => ' Registro Civil', 'users_id' => 1],
            [ 'abreviatura' => 'TI', 'descripcion' => ' Tarjeta de identidad.', 'users_id' => 1],
            [ 'abreviatura' => 'CC', 'descripcion' => ' Cédula de ciudadanía', 'users_id' => 1],
            [ 'abreviatura' => 'CE', 'descripcion' => ' Cédula de extranjería', 'users_id' => 1],
            [ 'abreviatura' => 'PA', 'descripcion' => ' Pasaporte', 'users_id' => 1],
            [ 'abreviatura' => 'MS', 'descripcion' => ' Menor sin identificación', 'users_id' => 1],
            [ 'abreviatura' => 'AS', 'descripcion' => ' Adulto sin identidad.', 'users_id' => 1]
        ]);


    }
    
}
