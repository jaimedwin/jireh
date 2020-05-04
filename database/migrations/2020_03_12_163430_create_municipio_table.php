<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('municipio', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->string('nombre', 70);
			$table->unsignedBigInteger('departamento_id')->index('municipio_FK');
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
		Schema::drop('expedicion');
	}

}
