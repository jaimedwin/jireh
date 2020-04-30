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
			$table->foreign('tipodocumentoidentificacion_id', 'personanatural_FK')->references('id')->on('tipodocumentoidentificacion')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('municipio_id', 'personanatural_FK_1')->references('id')->on('municipio')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('grado_id', 'personanatural_FK_2')->references('id')->on('grado')->onUpdate('SET NULL')->onDelete('SET NULL');
			$table->foreign('eps_id', 'personanatural_FK_3')->references('id')->on('eps')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('fondodepension_id', 'personanatural_FK_4')->references('id')->on('fondodepension')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
			$table->dropForeign('personanatural_FK_5');
		});
	}

}
