<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteprocesoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clienteproceso', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->unsignedBigInteger('personanatural_id')->index('clienteproceso_FK');
			$table->unsignedBigInteger('proceso_id')->index('clienteproceso_FK_1');
			$table->unsignedBigInteger('tipodemanda_id')->index('clienteproceso_FK_2');
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
		Schema::drop('clienteproceso');
	}

}
