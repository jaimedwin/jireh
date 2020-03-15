<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcesoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('proceso', function(Blueprint $table)
		{
			$table->bigIncrements('proceso_id');
			$table->string('codigo', 15)->unique('codigo');
			$table->string('numero', 35)->unique('numero');
			$table->unsignedBigInteger('ciudadproceso_id')->index('proceso_FK');
			$table->unsignedBigInteger('corporacion_id')->index('proceso_FK_1');
			$table->unsignedBigInteger('ponente_id')->index('proceso_FK_2');
			$table->unsignedBigInteger('estado_id')->index('proceso_FK_3');
			$table->unsignedBigInteger('recordatorio_id')->nullable()->index('proceso_FK_4');
			$table->unsignedBigInteger('users_id');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('proceso');
	}

}
