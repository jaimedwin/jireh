<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToDocumentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('documento', function(Blueprint $table)
		{
			$table->foreign('tipodocumento_id', 'documento_FK')->references('tipodocumento_id')->on('tipodocumento')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('personanatural_id', 'documento_FK_1')->references('personanatural_id')->on('personanatural')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('documento', function(Blueprint $table)
		{
			$table->dropForeign('documento_FK');
			$table->dropForeign('documento_FK_1');
		});
	}

}
