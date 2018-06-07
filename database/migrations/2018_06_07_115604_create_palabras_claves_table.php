<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalabrasClavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('palabras_claves', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->comment = "Palabra Clave";

            $table->integer('solucion_id')->unsigned();
            $table->foreign('solucion_id')->references('id')->on('solucions');

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
        Schema::dropIfExists('palabras_claves');
    }
}
