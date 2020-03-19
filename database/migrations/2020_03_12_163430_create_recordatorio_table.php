<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordatorioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recordatorio', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->string('observacion', 1000);
			$table->date('fecha');
			$table->unsignedBigInteger('proceso_id')->index('recordatorio_FK');
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
		Schema::drop('recordatorio');
	}

}
