<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPersonanaturalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('personanatural', function(Blueprint $table)
		{
			$table->foreign('tipodocumentoidentificacion_id', 'personanatural_FK')->references('tipodocumentoidentificacion_id')->on('tipodocumentoidentificacion')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('expedicion_id', 'personanatural_FK_1')->references('expedicion_id')->on('expedicion')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('grado_id', 'personanatural_FK_2')->references('grado_id')->on('grado')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('eps_id', 'personanatural_FK_3')->references('eps_id')->on('eps')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('personanatural_id', 'personanatural_FK_4')->references('fondodepension_id')->on('fondodepension')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('personanatural', function(Blueprint $table)
		{
			$table->dropForeign('personanatural_FK');
			$table->dropForeign('personanatural_FK_1');
			$table->dropForeign('personanatural_FK_2');
			$table->dropForeign('personanatural_FK_3');
			$table->dropForeign('personanatural_FK_4');
		});
	}

}
