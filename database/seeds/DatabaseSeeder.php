<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call(CorporacionSeeder::class);
        $this->call(CiudadprocesoSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(PonenteSeeder::class);
        $this->call(TipodocumentoidentificacionSeeder::class);  
        $this->call(FondodepensionSeeder::class);   
        $this->call(TipocontratoSeeder::class);   
        $this->call(EpsSeeder::class);   
        $this->call(DepartamentoSeeder::class);
        $this->call(MunicipioSeeder::class);
        $this->call(FuerzaCarreraGradoSeeder::class);   
        $this->call(TipodocumentoSeeder::class);
        $this->call(TipodemandaSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
    }
}
