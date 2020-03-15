<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelefonoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('telefono', function(Blueprint $table)
		{
			$table->bigIncrements('telefono_id');
			$table->string('numero', 50)->unique('numero');
			$table->boolean('principal')->default(0);
			$table->unsignedBigInteger('personanatural_id')->index('telefono_FK');
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
		Schema::drop('telefono');
	}

}
