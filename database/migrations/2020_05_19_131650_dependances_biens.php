<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DependancesBiens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependances_biens', function (Blueprint $table) {
            $table->unsignedBigInteger('id_bien');
            $table->foreign('id_bien')->references('id')->on('biens');
            $table->unsignedBigInteger('id_dependance');
            $table->foreign('id_dependance')->references('id')->on('dependances');
            $table->integer('superficie');
            $table->unique([
                'id_bien',
                'id_dependance'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dependances_biens');
    }
}
