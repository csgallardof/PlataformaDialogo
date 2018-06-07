<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCspReportesAlertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csp_reportes_alertas', function (Blueprint $table) {
            $table->increments('id');
            //Definicion de relacion con la tabla tipo_reporte
            $table->integer('estado_reporte_id')->index();
            $table->integer('periodo_id')->index();
            //Definicion de relacion con la tabla institucion
            $table->integer('institucion_id')->index();
            $table->datetime('fecha_atencion');
            $table->string('tema');
            $table->text('descripcion');
            $table->text('solucion_propuesta');
            $table->text('riesgo_principal');
            $table->string('fuente');
            $table->string('tipo_comunicacional');
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
        Schema::dropIfExists('csp_reportes_alertas');
    }
}
