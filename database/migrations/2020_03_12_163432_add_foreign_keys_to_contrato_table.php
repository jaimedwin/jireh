<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToContratoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contrato', function(Blueprint $table)
		{
			$table->foreign('personanatural_id', 'contrato_FK')->references('id')->on('personanatural')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('tipocontrato_id', 'contrato_FK_1')->references('id')->on('tipocontrato')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('proceso_id', 'contrato_FK_2')->references('id')->on('proceso')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('contrato', function(Blueprint $table)
		{
			$table->dropForeign('contrato_FK');
			$table->dropForeign('contrato_FK_1');
			$table->dropForeign('contrato_FK_2');
		});
	}

}
