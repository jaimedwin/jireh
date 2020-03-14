<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRegistroconsultaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('registroconsulta', function(Blueprint $table)
		{
			$table->foreign('personanatural_id', 'registroconsulta_FK')->references('personanatural_id')->on('personanatural')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('proceso_id', 'registroconsulta_FK_1')->references('proceso_id')->on('proceso')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('registroconsulta', function(Blueprint $table)
		{
			$table->dropForeign('registroconsulta_FK');
			$table->dropForeign('registroconsulta_FK_1');
		});
	}

}
