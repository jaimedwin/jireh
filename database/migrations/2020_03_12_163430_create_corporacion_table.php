<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorporacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('corporacion', function(Blueprint $table)
		{
			$table->bigIncrements('corporacion_id');
			$table->string('corporacion_nombre', 100)->unique('corporacion_nombre');
			$table->string('corporacion_correonotificacion', 320)->nullable();
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
		Schema::drop('corporacion');
	}

}
