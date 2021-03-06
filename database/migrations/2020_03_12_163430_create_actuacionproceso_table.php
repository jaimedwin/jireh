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
			$table->bigIncrements('id');
			$table->date('fechaactuacion');
			$table->string('actuacion', 250);
			$table->string('anotacion', 1000)->nullable();
			$table->string('nombrearchivo')->nullable();
			$table->date('fechainiciatermino')->nullable();
			$table->date('fechafinalizatermino')->nullable();
			$table->date('fecharegistro');
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
