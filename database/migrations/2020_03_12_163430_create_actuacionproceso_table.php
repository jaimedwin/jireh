<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActuacionprocesoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('actuacionproceso', function(Blueprint $table)
		{
			$table->bigIncrements('actuacionproceso_id');
			$table->date('actuacionproceso_fechaactuacion');
			$table->string('actuacionproceso_actuacion', 250);
			$table->string('actuacionproceso_anotacion', 1000)->nullable();
			$table->string('actuacionproceso_nombrearchivo',250);
			$table->date('actuacionproceso_fechainiciatermino')->nullable();
			$table->date('actuacionproceso_fechafinalizatermino')->nullable();
			$table->date('actuacionproceso_fecharegistro');
			$table->unsignedBigInteger('proceso_id')->index('actuacionproceso_FK');
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
		Schema::drop('actuacionproceso');
	}

}
