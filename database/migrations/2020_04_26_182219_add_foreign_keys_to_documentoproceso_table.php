<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToDocumentoprocesoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documentoproceso', function (Blueprint $table) {
            $table->foreign('tipodocumento_id', 'documentoproceso_FK')->references('id')->on('tipodocumento')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('proceso_id', 'documentoproceso_FK_1')->references('id')->on('proceso')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documentoproceso', function (Blueprint $table) {
            $table->dropForeign('documentoproceso_FK');
			$table->dropForeign('documentoproceso_FK_1');
        });
    }
}
