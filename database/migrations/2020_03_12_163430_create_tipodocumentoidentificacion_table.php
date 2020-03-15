<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipodocumentoidentificacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipodocumentoidentificacion', function(Blueprint $table)
		{
			$table->bigIncrements('tipodocumentoidentificacion_id');
			$table->string('abreviatura', 10)->unique('abreviatura');
			$table->string('descripcion', 200);
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
		Schema::drop('tipodocumentoidentificacion');
	}

}
