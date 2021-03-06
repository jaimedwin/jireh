<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pago', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->date('fecha');
			$table->unsignedBigInteger('abono');
			$table->string('nrecibo', 20)->nullable()->unique('nrecibo');
			$table->unsignedBigInteger('contrato_id')->index('FK_pago');
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
		Schema::drop('pago');
	}

}
