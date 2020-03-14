<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarreraTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('carrera', function(Blueprint $table)
		{
			$table->bigIncrements('carrera_id');
			$table->string('carrera_abreviatura', 10)->unique('carrera_abreviatura');
			$table->string('carrera_descripción', 50);
			$table->unsignedBigInteger('fuerza_id')->index('FK_carrera_fuerza');
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
		Schema::drop('carrera');
	}

}
