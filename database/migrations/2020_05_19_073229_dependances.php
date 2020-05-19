<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Dependances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('superficie');
            $table->string('nom');
            $table->unsignedBigInteger('id_bien');
            $table->foreign('id_bien')->references('id')->on('biens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dependances');
    }
}
