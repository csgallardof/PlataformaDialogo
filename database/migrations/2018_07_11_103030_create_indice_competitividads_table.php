<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndiceCompetitividadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indice_competitividads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_indice_competitividad')->comment="nombre del pilar del indice";
            $table->text('descripcion_indice_competitividad')->comment="descripcion nombre del pilar del indice";
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
        Schema::dropIfExists('indice_competitividads');
    }
}
