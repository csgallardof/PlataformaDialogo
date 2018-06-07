<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActorSolucionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actor_solucion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('solucion_id');
            $table->integer('tipo_actor');
            $table->integer('tipo_fuente');
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
        Schema::dropIfExists('actor_solucion');
    }
}