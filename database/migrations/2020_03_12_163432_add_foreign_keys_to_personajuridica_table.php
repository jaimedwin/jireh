<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPersonajuridicaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('personajuridica', function(Blueprint $table)
		{
			$table->foreign('personanatural_id', 'personajuridica_FK')->references('id')->on('personanatural')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('personajuridica', function(Blueprint $table)
		{
			$table->dropForeign('personajuridica_FK');
		});
	}

}
