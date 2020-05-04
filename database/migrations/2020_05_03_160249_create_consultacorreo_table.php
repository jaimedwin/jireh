<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultacorreoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultacorreo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('a', 320);
            $table->string('mensaje', 2000);
            $table->unsignedBigInteger('consultacorreotipo_id')->index('consultacorreo_FK');
            $table->dateTime('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultacorreo');
    }
}
