<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBoxidToClienteprocesoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clienteproceso', function (Blueprint $table) {
            $table->unsignedBigInteger('box_id')->index('clienteproceso_FK_3')->nullable();
			$table->foreign('box_id', 'clienteproceso_FK_3')->references('id')->on('box')->onUpdate('RESTRICT')->onDelete('RESTRICT');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clienteproceso', function (Blueprint $table) {
			$table->dropForeign('clienteproceso_FK_3');
            $table->dropColumn('box_id');
        });
    }
}
