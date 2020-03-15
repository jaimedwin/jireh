<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorreoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('correo', function(Blueprint $table)
		{
			$table->bigIncrements('correo_id');
			$table->string('electronico', 320)->unique('electronico');
			$table->boolean('principal')->default(0);
			$table->unsignedBigInteger('personanatural_id')->index('correo_FK');
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
		Schema::drop('correo');
	}

}
