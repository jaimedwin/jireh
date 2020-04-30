<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentoprocesoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentoproceso', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombrearchivo', 250);
			$table->unsignedBigInteger('tipodocumento_id')->index('documentoproceso_FK');
			$table->unsignedBigInteger('proceso_id')->index('documentoproceso_FK_1');
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
        Schema::dropIfExists('documentoproceso');
    }
}
