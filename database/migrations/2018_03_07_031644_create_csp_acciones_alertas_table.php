<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCspAccionesAlertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csp_acciones_alertas', function (Blueprint $table) {
            $table->increments('id');
            //Definicion de relacion con la tabla tipo_reporte
            $table->integer('reporte_alerta_id')->index();
            $table->integer('periodo_id')->index();
            $table->text('acciones');
            $table->datetime('fecha');
            $table->string('anexo');
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
        Schema::dropIfExists('csp_acciones_alertas');
    }
}
