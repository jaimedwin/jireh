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
			$table->bigIncrements('id');
			$table->boolean('contrato')->default(0)->nullable();
			$table->string('codigo', 15)->unique('personanatural_UN1');
			$table->string('nombres', 100);
			$table->string('apellidopaterno', 75)->nullable();
			$table->string('apellidomaterno', 75)->nullable();
			$table->unsignedBigInteger('tipodocumentoidentificacion_id')->index('personanatural_FK');
			$table->string('numerodocumento', 15)->unique('personanatural_UN');
			$table->unsignedBigInteger('expedicion_id')->index('personanatural_FK_1');
			$table->date('fechaexpedicion')->nullable();
			$table->date('fechanacimiento')->nullable();
			$table->string('direccion', 500);
			$table->unsignedBigInteger('eps_id')->index('personanatural_FK_3');
			$table->unsignedBigInteger('fondodepension_id')->index('personanatural_FK_4');
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
