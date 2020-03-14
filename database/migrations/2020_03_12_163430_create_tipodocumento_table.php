<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipodocumentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipodocumento', function(Blueprint $table)
		{
			$table->bigIncrements('tipodocumento_id');
			$table->string('tipodocumento_abreviatura', 5)->unique('tipodocumento_abreviatura');
			$table->string('tipodocumento_descripcion', 30);
			$table->string('tipodocumento_comentario', 1000)->nullable();
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
		Schema::drop('tipodocumento');
	}

}
