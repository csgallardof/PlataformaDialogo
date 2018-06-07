<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCspPeriodoAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csp_periodo_agendas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('año');
            $table->integer('mes');
            $table->string('semana');
            $table->datetime('fecha_inicio');
            $table->datetime('fecha_final');
            $table->integer('semana_anio');
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
        Schema::dropIfExists('csp_periodo_agendas');
    }
}
