<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonajuridicaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('personajuridica', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->string('nit', 35);
			$table->string('razonsocial', 500);
			$table->string('direccion', 500)->nullable();
			$table->unsignedBigInteger('personanatural_id')->index('personajuridica_FK');
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
		Schema::drop('personajuridica');
	}

}
