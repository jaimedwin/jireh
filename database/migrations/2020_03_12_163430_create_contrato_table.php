<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contrato', function(Blueprint $table)
		{
			$table->bigIncrements('contrato_id');
			$table->string('contrato_ruta', 250);
			$table->unsignedBigInteger('contrato_valor');
			$table->unsignedBigInteger('personanatural_id')->index('contrato_FK');
			$table->unsignedBigInteger('tipocontrato_id')->index('contrato_FK_1');
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
		Schema::drop('contrato');
	}

}
