<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePonenteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ponente', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->string('nombrecompleto', 200)->unique('nombrecompleto');
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
		Schema::drop('ponente');
	}

}
