<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonanaturalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('personanatural', function(Blueprint $table)
		{
			$table->bigIncrements('personanatural_id');
			$table->string('personanatural_codigo', 15)->unique('personanatural_UN1');
			$table->string('personanatural_nombres', 100);
			$table->string('personanatural_apellidopaterno', 75)->nullable();
			$table->string('personanatural_apellidomaterno', 75)->nullable();
			$table->unsignedBigInteger('tipodocumentoidentificacion_id')->index('personanatural_FK');
			$table->string('personanatural_numerodocumento', 15)->unique('personanatural_UN');
			$table->unsignedBigInteger('expedicion_id')->index('personanatural_FK_1');
			$table->date('personanatural_fechaexpedicion')->nullable();
			$table->date('personanatural_fechanacimiento')->nullable();
			$table->string('personanatural_direccion', 500);
			$table->unsignedBigInteger('eps_id')->index('personanatural_FK_3');
			$table->unsignedBigInteger('fondodepensiones_id');
			$table->unsignedBigInteger('grado_id')->nullable()->index('personanatural_FK_2');
			$table->unsignedBigInteger('users_id');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('personanatural');
	}

}
