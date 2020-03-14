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
			$table->bigIncrements('personajuridica_id');
			$table->string('personajuridica_nit', 35);
			$table->string('personajuridica_razonsocial', 500);
			$table->string('personajuridica_direccion', 500)->nullable();
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
