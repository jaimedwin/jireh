<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProcesoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('proceso', function(Blueprint $table)
		{
			$table->foreign('ciudadproceso_id', 'proceso_FK')->references('id')->on('ciudadproceso')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('corporacion_id', 'proceso_FK_1')->references('id')->on('corporacion')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('ponente_id', 'proceso_FK_2')->references('id')->on('ponente')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('estado_id', 'proceso_FK_3')->references('id')->on('estado')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('proceso', function(Blueprint $table)
		{
			$table->dropForeign('proceso_FK');
			$table->dropForeign('proceso_FK_1');
			$table->dropForeign('proceso_FK_2');
			$table->dropForeign('proceso_FK_3');
		});
	}

}
