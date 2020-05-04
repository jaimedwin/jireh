<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToConsultacorreoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consultacorreo', function (Blueprint $table) {
            $table->foreign('consultacorreotipo_id', 'consultacorreo_FK')->references('id')->on('consultacorreotipo')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consultacorreo', function (Blueprint $table) {
            $table->dropForeign('consultacorreo_FK');
        });
    }
}
