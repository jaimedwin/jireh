<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('grado', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->string('abreviatura', 10);
			$table->string('descripcion', 50);
			$table->unsignedBigInteger('carrera_id')->index('FK__carrera');
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
		Schema::drop('grado');
	}

}
