<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateRegistroconsultaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('registroconsulta', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->unsignedBigInteger('personanatural_id')->index('registroconsulta_FK');
			$table->unsignedBigInteger('proceso_id')->index('registroconsulta_FK_1');
			$table->dateTime('created_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('registroconsulta');
	}

}
