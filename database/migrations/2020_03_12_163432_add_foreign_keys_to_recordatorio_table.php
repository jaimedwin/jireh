<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRecordatorioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('recordatorio', function(Blueprint $table)
		{
			$table->foreign('proceso_id', 'recordatorio_FK')->references('id')->on('proceso')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('recordatorio', function(Blueprint $table)
		{
			$table->dropForeign('recordatorio_FK');
		});
	}

}