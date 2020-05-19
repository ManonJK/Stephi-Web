<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Biens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('superficie');
            $table->integer('nb_pieces');
            $table->integer('etage');
            $table->string('localisation');
            $table->string('descriptif');
            $table->float('prix_min');
            $table->float('prix_max');
            $table->float('prix_vente');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->unsignedBigInteger('id_type');
            $table->foreign('id_type')->references('id')->on('types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biens');
    }
}
