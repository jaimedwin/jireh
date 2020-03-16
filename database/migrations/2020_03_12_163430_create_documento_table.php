<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documento', function(Blueprint $table)
		{
			$table->bigIncrements('id', true);
			$table->string('nombrearchivo', 250);
			$table->unsignedBigInteger('tipodocumento_id')->index('FK__tipodocumento');
			$table->unsignedBigInteger('personanatural_id')->index('documento_FK_1');
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
		Schema::drop('documento');
	}

}
