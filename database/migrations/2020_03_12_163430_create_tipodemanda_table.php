<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipodemandaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipodemanda', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->string('abreviatura', 10);
			$table->string('descripcion', 250);
			$table->string('comentario', 1000)->nullable();
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
		Schema::drop('tipodemanda');
	}

}
