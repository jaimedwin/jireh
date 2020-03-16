<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToActuacionprocesoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('actuacionproceso', function(Blueprint $table)
		{
			$table->foreign('proceso_id', 'actuacionproceso_FK')->references('id')->on('proceso')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('actuacionproceso', function(Blueprint $table)
		{
			$table->dropForeign('actuacionproceso_FK');
		});
	}

}
