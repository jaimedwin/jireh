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
			$table->string('telefono_numero', 50)->unique('telefono_numero');
			$table->boolean('telefono_principal')->default(0);
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
