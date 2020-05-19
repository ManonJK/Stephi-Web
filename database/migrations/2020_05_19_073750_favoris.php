<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Favoris extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favoris', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_bien');
            $table->foreign('id_bien')->references('id')->on('biens');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favoris');
    }
}
