<?php

use Illuminate\Database\Seeder;
use App\Models\Fuerza;
use App\Models\Carrera;
use App\Models\Grado;
use Illuminate\Support\Facades\DB;

class FuerzaCarreraGradoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grado')->delete();
        DB::table('carrera')->delete();
        DB::table('fuerza')->delete();

        $fuerzas = [  
            ['id' => 1, 'abreviatura' => 'PNC',   'descripcion' => 'Policía Nacional de Colombia', 'users_id' => 1],
            ['id' => 2, 'abreviatura' => 'FAC',   'descripcion' => 'Fuerza Aérea Colombiana', 'users_id' => 1],
            ['id' => 3, 'abreviatura' => 'EJC',   'descripcion' => 'Ejército Nacional de Colombia', 'users_id' => 1], 
            ['id' => 4, 'abreviatura' => 'ARC',   'descripcion' => 'Armada de la República de Colombia', 'users_id' => 1],
            ['id' => 5, 'abreviatura' => 'NA',   'descripcion' => 'No aplica', 'users_id' => 1],
        ];
        $carreras = [            
            ['id' => 1, 'abreviatura' => 'OF',   'descripcion' => 'Oficiales', 'fuerza_id' => 1, 'users_id' => 1],
            ['id' => 2, 'abreviatura' => 'SO',   'descripcion' => 'Suboficiales', 'fuerza_id' => 1, 'users_id' => 1],
            ['id' => 3, 'abreviatura' => 'ME',   'descripcion' => 'Nivel Ejecutivo', 'fuerza_id' => 1, 'users_id' => 1],
            ['id' => 4, 'abreviatura' => 'OF',   'descripcion' => 'Oficiales', 'fuerza_id' => 2, 'users_id' => 1],
            ['id' => 5, 'abreviatura' => 'SO',   'descripcion' => 'Suboficiales', 'fuerza_id' => 2, 'users_id' => 1],
            ['id' => 6, 'abreviatura' => 'OF',   'descripcion' => 'Oficiales', 'fuerza_id' => 3, 'users_id' => 1],
            ['id' => 7, 'abreviatura' => 'SO',   'descripcion' => 'Suboficiales', 'fuerza_id' => 3, 'users_id' => 1],
            ['id' => 8, 'abreviatura' => 'OFS',   'descripcion' => 'Oficiales Superiores', 'fuerza_id' => 4, 'users_id' => 1],
            ['id' => 9, 'abreviatura' => 'OFCIM',   'descripcion' => 'Oficiales del Cuerpo de Infantería de Marina', 'fuerza_id' => 4, 'users_id' => 1],
            ['id' => 10, 'abreviatura' => 'SO',   'descripcion' => 'Suboficiales', 'fuerza_id' => 4, 'users_id' => 1],
            ['id' => 11, 'abreviatura' => 'SOCIM',   'descripcion' => 'Suboficiales del Cuerpo de Infantería de Marina', 'fuerza_id' => 4, 'users_id' => 1],
            ['id' => 12, 'abreviatura' => 'NA',   'descripcion' => 'No aplica', 'fuerza_id' => 5, 'users_id' => 1],
        ];
        $grados = [            
            ['id' => 1, 'abreviatura' => 'GR',   'descripcion' => 'General', 'carrera_id' => 1, 'users_id' => 1],
            ['id' => 2, 'abreviatura' => 'MG',   'descripcion' => 'Mayor General', 'carrera_id' => 1, 'users_id' => 1],
            ['id' => 3, 'abreviatura' => 'BG',   'descripcion' => 'Brigadier General', 'carrera_id' => 1, 'users_id' => 1],
            ['id' => 4, 'abreviatura' => 'CR',   'descripcion' => 'Coronel', 'carrera_id' => 1, 'users_id' => 1],
            ['id' => 5, 'abreviatura' => 'TC',   'descripcion' => 'Teniente Coronel', 'carrera_id' => 1, 'users_id' => 1],
            ['id' => 6, 'abreviatura' => 'MY',   'descripcion' => 'Mayor', 'carrera_id' => 1, 'users_id' => 1],
            ['id' => 7, 'abreviatura' => 'CT',   'descripcion' => 'Capitán', 'carrera_id' => 1, 'users_id' => 1],
            ['id' => 8, 'abreviatura' => 'TE',   'descripcion' => 'Teniente', 'carrera_id' => 1, 'users_id' => 1],
            ['id' => 9, 'abreviatura' => 'ST',   'descripcion' => 'Subteniente', 'carrera_id' => 1, 'users_id' => 1],
            ['id' => 10, 'abreviatura' => 'SM',   'descripcion' => 'Sargento Mayor', 'carrera_id' => 2, 'users_id' => 1],
            ['id' => 11, 'abreviatura' => 'SP',   'descripcion' => 'Sargento Primero', 'carrera_id' => 2, 'users_id' => 1],
            ['id' => 12, 'abreviatura' => 'SV',   'descripcion' => 'Sargento Vice Primero', 'carrera_id' => 2, 'users_id' => 1],
            ['id' => 13, 'abreviatura' => 'SS',   'descripcion' => 'Sargento Segundo', 'carrera_id' => 2, 'users_id' => 1],
            ['id' => 14, 'abreviatura' => 'CP',   'descripcion' => 'Cabo Primero', 'carrera_id' => 2, 'users_id' => 1],
            ['id' => 15, 'abreviatura' => 'CS',   'descripcion' => 'Cabo Segundo', 'carrera_id' => 2, 'users_id' => 1],
            ['id' => 16, 'abreviatura' => 'DG',   'descripcion' => 'Dragoneanten', 'carrera_id' => 2, 'users_id' => 1],
            ['id' => 17, 'abreviatura' => 'AG',   'descripcion' => 'Agente del Cuerpo Profesional', 'carrera_id' => 2, 'users_id' => 1],
            ['id' => 18, 'abreviatura' => 'CM',   'descripcion' => 'Comisario', 'carrera_id' => 3, 'users_id' => 1],
            ['id' => 19, 'abreviatura' => 'SC',   'descripcion' => 'Subcomisario', 'carrera_id' => 3, 'users_id' => 1],
            ['id' => 20, 'abreviatura' => 'IJ',   'descripcion' => 'Intendente Jefe', 'carrera_id' => 3, 'users_id' => 1],
            ['id' => 21, 'abreviatura' => 'IT',   'descripcion' => 'Intendente', 'carrera_id' => 3, 'users_id' => 1],
            ['id' => 22, 'abreviatura' => 'SI',   'descripcion' => 'Subintendente', 'carrera_id' => 3, 'users_id' => 1],
            ['id' => 23, 'abreviatura' => 'PT',   'descripcion' => 'Patrullero', 'carrera_id' => 3, 'users_id' => 1],
            ['id' => 24, 'abreviatura' => 'GR',   'descripcion' => 'General', 'carrera_id' => 4, 'users_id' => 1],
            ['id' => 25, 'abreviatura' => 'MG',   'descripcion' => 'Mayor General', 'carrera_id' => 4, 'users_id' => 1],
            ['id' => 26, 'abreviatura' => 'BG',   'descripcion' => 'Brigadier General', 'carrera_id' => 4, 'users_id' => 1],
            ['id' => 27, 'abreviatura' => 'CR',   'descripcion' => 'Coronel', 'carrera_id' => 4, 'users_id' => 1],
            ['id' => 28, 'abreviatura' => 'TC',   'descripcion' => 'Teniente Coronel', 'carrera_id' => 4, 'users_id' => 1],
            ['id' => 29, 'abreviatura' => 'MY',   'descripcion' => 'Mayor', 'carrera_id' => 4, 'users_id' => 1],
            ['id' => 30, 'abreviatura' => 'CT',   'descripcion' => 'Capitán', 'carrera_id' => 4, 'users_id' => 1],
            ['id' => 31, 'abreviatura' => 'TE',   'descripcion' => 'Teniente', 'carrera_id' => 4, 'users_id' => 1],
            ['id' => 32, 'abreviatura' => 'ST',   'descripcion' => 'Subteniente', 'carrera_id' => 4, 'users_id' => 1],
            ['id' => 33, 'abreviatura' => 'TJC',   'descripcion' => 'Técnico Jefe de Comando', 'carrera_id' => 5, 'users_id' => 1],
            ['id' => 34, 'abreviatura' => 'TJ',   'descripcion' => 'Técnico Jefe', 'carrera_id' => 5, 'users_id' => 1],
            ['id' => 35, 'abreviatura' => 'TS',   'descripcion' => 'Técnico Subjefe', 'carrera_id' => 5, 'users_id' => 1],
            ['id' => 36, 'abreviatura' => 'T1',   'descripcion' => 'Técnico Primero', 'carrera_id' => 5, 'users_id' => 1],
            ['id' => 37, 'abreviatura' => 'T2',   'descripcion' => 'Técnico Segundo', 'carrera_id' => 5, 'users_id' => 1],
            ['id' => 38, 'abreviatura' => 'T3',   'descripcion' => 'Técnico Tercero', 'carrera_id' => 5, 'users_id' => 1],
            ['id' => 39, 'abreviatura' => 'T4',   'descripcion' => 'Técnico Cuarto', 'carrera_id' => 5, 'users_id' => 1],
            ['id' => 40, 'abreviatura' => 'AT',   'descripcion' => 'Aerotécnico', 'carrera_id' => 5, 'users_id' => 1],
            ['id' => 41, 'abreviatura' => 'SL',   'descripcion' => 'Soldado R/B Fac', 'carrera_id' => 5, 'users_id' => 1],
            ['id' => 42, 'abreviatura' => 'GR',   'descripcion' => 'General', 'carrera_id' => 6, 'users_id' => 1],
            ['id' => 43, 'abreviatura' => 'MG',   'descripcion' => 'Mayor General', 'carrera_id' => 6, 'users_id' => 1],
            ['id' => 44, 'abreviatura' => 'BG',   'descripcion' => 'Brigadier General', 'carrera_id' => 6, 'users_id' => 1],
            ['id' => 45, 'abreviatura' => 'CR',   'descripcion' => 'Coronel', 'carrera_id' => 6, 'users_id' => 1],
            ['id' => 46, 'abreviatura' => 'TC',   'descripcion' => 'Teniente Coronel', 'carrera_id' => 6, 'users_id' => 1],
            ['id' => 47, 'abreviatura' => 'MY',   'descripcion' => 'Mayor', 'carrera_id' => 6, 'users_id' => 1],
            ['id' => 48, 'abreviatura' => 'CT',   'descripcion' => 'Capitán', 'carrera_id' => 6, 'users_id' => 1],
            ['id' => 49, 'abreviatura' => 'TE',   'descripcion' => 'Teniente', 'carrera_id' => 6, 'users_id' => 1],
            ['id' => 50, 'abreviatura' => 'ST',   'descripcion' => 'Subteniente', 'carrera_id' => 6, 'users_id' => 1],
            ['id' => 51, 'abreviatura' => 'SMCC',   'descripcion' => 'Sargento Mayor de Comando Conjunto', 'carrera_id' => 7, 'users_id' => 1],
            ['id' => 52, 'abreviatura' => 'SMC',   'descripcion' => 'Sargento Mayor de Comando', 'carrera_id' => 7, 'users_id' => 1],
            ['id' => 53, 'abreviatura' => 'SM',   'descripcion' => 'Sargento Mayor', 'carrera_id' => 7, 'users_id' => 1],
            ['id' => 54, 'abreviatura' => 'SP',   'descripcion' => 'Sargento Primero', 'carrera_id' => 7, 'users_id' => 1],
            ['id' => 55, 'abreviatura' => 'SV',   'descripcion' => 'Sargento Viceprimero', 'carrera_id' => 7, 'users_id' => 1],
            ['id' => 56, 'abreviatura' => 'SS',   'descripcion' => 'Sargento Segundo', 'carrera_id' => 7, 'users_id' => 1],
            ['id' => 57, 'abreviatura' => 'CP',   'descripcion' => 'Cabo Primero', 'carrera_id' => 7, 'users_id' => 1],
            ['id' => 58, 'abreviatura' => 'CS',   'descripcion' => 'Cabo Segundo', 'carrera_id' => 7, 'users_id' => 1],
            ['id' => 59, 'abreviatura' => 'C3',   'descripcion' => 'Cabo Tercero', 'carrera_id' => 7, 'users_id' => 1],
            ['id' => 60, 'abreviatura' => 'DG',   'descripcion' => 'Dragoneante', 'carrera_id' => 7, 'users_id' => 1],
            ['id' => 61, 'abreviatura' => 'SP',   'descripcion' => 'Soldado Profesional', 'carrera_id' => 7, 'users_id' => 1],
            ['id' => 62, 'abreviatura' => 'SB',   'descripcion' => 'Soldado Bachiller', 'carrera_id' => 7, 'users_id' => 1],
            ['id' => 63, 'abreviatura' => 'SR',   'descripcion' => 'Soldado Regular', 'carrera_id' => 7, 'users_id' => 1],
            ['id' => 64, 'abreviatura' => 'ALM',   'descripcion' => 'Almirante', 'carrera_id' => 8, 'users_id' => 1],
            ['id' => 65, 'abreviatura' => 'VA',   'descripcion' => 'Vicealmirante', 'carrera_id' => 8, 'users_id' => 1],
            ['id' => 66, 'abreviatura' => 'CA',   'descripcion' => 'Contralmirante	', 'carrera_id' => 8, 'users_id' => 1],
            ['id' => 67, 'abreviatura' => 'CN',   'descripcion' => 'Capitán de Navío', 'carrera_id' => 8, 'users_id' => 1],
            ['id' => 68, 'abreviatura' => 'CF',   'descripcion' => 'Capitán de Fragata', 'carrera_id' => 8, 'users_id' => 1],
            ['id' => 69, 'abreviatura' => 'CC',   'descripcion' => 'Capitán de Corbeta', 'carrera_id' => 8, 'users_id' => 1],
            ['id' => 70, 'abreviatura' => 'TN',   'descripcion' => 'Teniente de Navío', 'carrera_id' => 8, 'users_id' => 1],
            ['id' => 71, 'abreviatura' => 'TF',   'descripcion' => 'Teniente de Fragata', 'carrera_id' => 8, 'users_id' => 1],
            ['id' => 72, 'abreviatura' => 'TK',   'descripcion' => 'Teniente de Corbeta', 'carrera_id' => 8, 'users_id' => 1],
            ['id' => 73, 'abreviatura' => 'GRCIM',   'descripcion' => 'General', 'carrera_id' => 9, 'users_id' => 1],
            ['id' => 74, 'abreviatura' => 'MGCIM',   'descripcion' => 'Mayor General', 'carrera_id' => 9, 'users_id' => 1],
            ['id' => 75, 'abreviatura' => 'BGCIM',   'descripcion' => 'Brigadier General', 'carrera_id' => 9, 'users_id' => 1],
            ['id' => 76, 'abreviatura' => 'CRCIM',   'descripcion' => 'Coronel', 'carrera_id' => 9, 'users_id' => 1],
            ['id' => 77, 'abreviatura' => 'TCCIM',   'descripcion' => 'Teniente Coronel', 'carrera_id' => 9, 'users_id' => 1],
            ['id' => 78, 'abreviatura' => 'MYCIM',   'descripcion' => 'Mayor', 'carrera_id' => 9, 'users_id' => 1],
            ['id' => 79, 'abreviatura' => 'CTCIM',   'descripcion' => 'Capitán', 'carrera_id' => 9, 'users_id' => 1],
            ['id' => 80, 'abreviatura' => 'TECIM',   'descripcion' => 'Teniente', 'carrera_id' => 9, 'users_id' => 1],
            ['id' => 81, 'abreviatura' => 'STCIM',   'descripcion' => 'Subteniente', 'carrera_id' => 9, 'users_id' => 1],
            ['id' => 82, 'abreviatura' => 'SJTCC',   'descripcion' => 'Suboficial Jefe Técnico de Comando Conjunto', 'carrera_id' => 10, 'users_id' => 1],
            ['id' => 83, 'abreviatura' => 'SJTC',    'descripcion' => 'Suboficial Jefe Técnico de Comando', 'carrera_id' => 10, 'users_id' => 1],
            ['id' => 84, 'abreviatura' => 'SJT',     'descripcion' => 'Suboficial Jefe Técnico', 'carrera_id' => 10, 'users_id' => 1],
            ['id' => 85, 'abreviatura' => 'SJ',      'descripcion' => 'Suboficial Jefe', 'carrera_id' => 10, 'users_id' => 1],
            ['id' => 86, 'abreviatura' => 'S1',      'descripcion' => 'Suboficial Primero', 'carrera_id' => 10, 'users_id' => 1],
            ['id' => 87, 'abreviatura' => 'S2',      'descripcion' => 'Suboficial Segundo', 'carrera_id' => 10, 'users_id' => 1],
            ['id' => 88, 'abreviatura' => 'S3',      'descripcion' => 'Suboficial Tercero', 'carrera_id' => 10, 'users_id' => 1],
            ['id' => 89, 'abreviatura' => 'MA1',     'descripcion' => 'Marinero Primero', 'carrera_id' => 10, 'users_id' => 1],
            ['id' => 90, 'abreviatura' => 'MA2',     'descripcion' => 'Marinero Segundo', 'carrera_id' => 10, 'users_id' => 1],
            ['id' => 91, 'abreviatura' => 'Gmt2',    'descripcion' => 'Grumete de segundo año', 'carrera_id' => 10, 'users_id' => 1],
            ['id' => 92, 'abreviatura' => 'Gmt1',    'descripcion' => 'Grumete de primer año', 'carrera_id' => 10, 'users_id' => 1],
            ['id' => 93, 'abreviatura' => 'SMCCCIM',   'descripcion' => 'Sargento Mayor de Comando Conjunto', 'carrera_id' => 11, 'users_id' => 1],
            ['id' => 94, 'abreviatura' => 'SMCCIM',   'descripcion' => 'Sargento Mayor de Comando', 'carrera_id' => 11, 'users_id' => 1],
            ['id' => 95, 'abreviatura' => 'SMCIM',   'descripcion' => 'Sargento Mayor', 'carrera_id' => 11, 'users_id' => 1],
            ['id' => 96, 'abreviatura' => 'SPCIM',   'descripcion' => 'Sargento Primero', 'carrera_id' => 11, 'users_id' => 1],
            ['id' => 97, 'abreviatura' => 'SVCIM',   'descripcion' => 'Sargento Viceprimero', 'carrera_id' => 11, 'users_id' => 1],
            ['id' => 98, 'abreviatura' => 'SSCIM',   'descripcion' => 'Sargento Segundo', 'carrera_id' => 11, 'users_id' => 1],
            ['id' => 99, 'abreviatura' => 'CPCIM',   'descripcion' => 'Cabo Primero', 'carrera_id' => 11, 'users_id' => 1],
            ['id' => 100, 'abreviatura' => 'CSCIM',   'descripcion' => 'Cabo Segundo', 'carrera_id' => 11, 'users_id' => 1],
            ['id' => 101, 'abreviatura' => 'C3CIM',   'descripcion' => 'Cabo Tercero	', 'carrera_id' => 11, 'users_id' => 1],
            ['id' => 102, 'abreviatura' => 'IMP',   'descripcion' => 'Infante de Marina Profesional', 'carrera_id' => 11, 'users_id' => 1],
            ['id' => 103, 'abreviatura' => 'IMB',   'descripcion' => 'Infante de Marina Bachiller', 'carrera_id' => 11, 'users_id' => 1],
            ['id' => 104, 'abreviatura' => 'IMR',   'descripcion' => 'Infante de Marina Regular', 'carrera_id' => 11, 'users_id' => 1],
            ['id' => 105, 'abreviatura' => 'NA',   'descripcion' => 'No aplica', 'carrera_id' => 12, 'users_id' => 1],
        ];
    
        foreach ($fuerzas as $f) {
            Fuerza::create($f);
        }

        foreach ($carreras as $c) {
            Carrera::create($c);
        }

        foreach ($grados as $g) {
            Grado::create($g);
        }
    }
}
