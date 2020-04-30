<?php

use Illuminate\Database\Seeder;
use App\Models\Ponente;
use Illuminate\Support\Facades\DB;

class PonenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ponente')->truncate();

        Ponente::insert([
            [ 'nombrecompleto' => 'ALBERTO ESPINOSA BOLAÑOS', 'users_id' => 1],
            [ 'nombrecompleto' => 'AMPARO OVIEDO PINTO', 'users_id' => 1],
            [ 'nombrecompleto' => 'ANDRES MEDINA PINEDA', 'users_id' => 1],
            [ 'nombrecompleto' => 'ANDREW JULIAN MARTINEZ MARTINEZ', 'users_id' => 1],
            [ 'nombrecompleto' => 'ANGEL IGNACIO ALVAREZ SILVA', 'users_id' => 1],
            [ 'nombrecompleto' => 'ANGELA MARIA JOJOA VELASQUEZ', 'users_id' => 1],
            [ 'nombrecompleto' => 'ANGELICA ALEXANDRA SANDOVAL AVILA', 'users_id' => 1],
            [ 'nombrecompleto' => 'AUGUSTO MORALES VALENCIA', 'users_id' => 1],
            [ 'nombrecompleto' => 'BEATRIZ HELENA ESCOBAR ROJAS', 'users_id' => 1],
            [ 'nombrecompleto' => 'BELISARIO BELTRAN BASTIDAS', 'users_id' => 1],
            [ 'nombrecompleto' => 'CARLOS ALBERTO ORLANDO JAIQUEL', 'users_id' => 1],
            [ 'nombrecompleto' => 'CARLOS ARTURO MENDIETA RODRIGUEZ', 'users_id' => 1],
            [ 'nombrecompleto' => 'CARLOS MARIO PEÑA DIAZ', 'users_id' => 1],
            [ 'nombrecompleto' => 'CARMELO PERDOMO CUETER', 'users_id' => 1],
            [ 'nombrecompleto' => 'CARMEN ALICIA RENGIFO SANGUINO', 'users_id' => 1],
            [ 'nombrecompleto' => 'CERVELEON PADILLA LINARES', 'users_id' => 1],
            [ 'nombrecompleto' => 'CLAUDIA PATRICIA ALONSO PEREZ', 'users_id' => 1],
            [ 'nombrecompleto' => 'DIANA MILENA ORJUELA CUARTAS', 'users_id' => 1],
            [ 'nombrecompleto' => 'ETNA PATRICIA SALAMANCA GALLO', 'users_id' => 1],
            [ 'nombrecompleto' => 'GABRIEL VALBUENA HERNANDEZ', 'users_id' => 1],
            [ 'nombrecompleto' => 'GLORIA MARIA GOMEZ MONTOYA', 'users_id' => 1],
            [ 'nombrecompleto' => 'ISRAEL SOLER PEDROZA', 'users_id' => 1],
            [ 'nombrecompleto' => 'JAIME ALBERTO GALEANO GARZON', 'users_id' => 1],
            [ 'nombrecompleto' => 'JAIRO RESTREPO CACERES', 'users_id' => 1],
            [ 'nombrecompleto' => 'JOHN LIBARDO ANDRADE FLOREZ', 'users_id' => 1],
            [ 'nombrecompleto' => 'JOSE ALETH RUIZ CASTRO', 'users_id' => 1],
            [ 'nombrecompleto' => 'JOSE ANDRES ROJAS VILLA', 'users_id' => 1],
            [ 'nombrecompleto' => 'JOSE MARIA ARMENTA FUENTES', 'users_id' => 1],
            [ 'nombrecompleto' => 'JOSE MARIA MOW HERRERA', 'users_id' => 1],
            [ 'nombrecompleto' => 'JOSE RODRIGO ROMERO ROMERO', 'users_id' => 1],
            [ 'nombrecompleto' => 'JUAN CARLOS HINCAPIE MEJIA', 'users_id' => 1],
            [ 'nombrecompleto' => 'LEONARDO RODRIGUEZ ARANGO', 'users_id' => 1],
            [ 'nombrecompleto' => 'LINA MARCELA CLEVES ROA', 'users_id' => 1],
            [ 'nombrecompleto' => 'LUIS ALBERTO ALVAREZ PARRA', 'users_id' => 1],
            [ 'nombrecompleto' => 'LUIS ALFREDO ZAMORA ACOSTA', 'users_id' => 1],
            [ 'nombrecompleto' => 'LUIS GILBERTO ORTEGON ORTEGON', 'users_id' => 1],
            [ 'nombrecompleto' => 'LUIS NORBERTO CERMEÑO', 'users_id' => 1],
            [ 'nombrecompleto' => 'MOISES RODRIGO MAZABEL PINZON', 'users_id' => 1],
            [ 'nombrecompleto' => 'NESTOR JAVIER CALVO CHAVES', 'users_id' => 1],
            [ 'nombrecompleto' => 'OSCAR SILVIO NARVAEZ DAZA', 'users_id' => 1],
            [ 'nombrecompleto' => 'PATRICIA FEUILLET PALOMARES', 'users_id' => 1],
            [ 'nombrecompleto' => 'PATRICIA VICTORIA MANJARRES BRAVO', 'users_id' => 1],
            [ 'nombrecompleto' => 'RAFAEL FRANCISCO SUAREZ VARGAS', 'users_id' => 1],
            [ 'nombrecompleto' => 'RAMIRO IGNACIO DUEÑAS RUGNON', 'users_id' => 1],
            [ 'nombrecompleto' => 'RAMON GONZALEZ GONZALEZ', 'users_id' => 1],
            [ 'nombrecompleto' => 'ROSA MILENA ROBLES ESPINOSA', 'users_id' => 1],
            [ 'nombrecompleto' => 'SANDRA LUCIA OJEDA INSUASTY ', 'users_id' => 1],
            [ 'nombrecompleto' => 'VICTOR ADOLFO HERNANDEZ DIAZ', 'users_id' => 1]
        ]);
    }

}
