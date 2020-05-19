<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ventes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('status', ['En cours', 'Annulée', 'Vendu']);
            $table->date('date_parution');
            $table->date('date_vente');
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
        Schema::dropIfExists('ventes');
    }
}
