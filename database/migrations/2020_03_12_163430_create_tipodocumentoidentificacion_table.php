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
			$table->string('tipodocumentoidentificacion_abreviatura', 10)->unique('tipodocumentoidentificacion_UN');
			$table->string('tipodocumentoidentificacion_descripcion', 200);
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
