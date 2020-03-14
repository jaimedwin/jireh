<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCorreoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('correo', function(Blueprint $table)
		{
			$table->foreign('personanatural_id', 'correo_FK')->references('personanatural_id')->on('personanatural')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('correo', function(Blueprint $table)
		{
			$table->dropForeign('correo_FK');
		});
	}

}
