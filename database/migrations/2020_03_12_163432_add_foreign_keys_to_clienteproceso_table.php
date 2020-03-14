<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToClienteprocesoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('clienteproceso', function(Blueprint $table)
		{
			$table->foreign('personanatural_id', 'clienteproceso_FK')->references('personanatural_id')->on('personanatural')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('proceso_id', 'clienteproceso_FK_1')->references('proceso_id')->on('proceso')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('tipodemanda_id', 'clienteproceso_FK_2')->references('tipodemanda_id')->on('tipodemanda')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('clienteproceso', function(Blueprint $table)
		{
			$table->dropForeign('clienteproceso_FK');
			$table->dropForeign('clienteproceso_FK_1');
			$table->dropForeign('clienteproceso_FK_2');
		});
	}

}
