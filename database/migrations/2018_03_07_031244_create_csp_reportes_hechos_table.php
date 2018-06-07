<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCspReportesHechosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csp_reportes_hechos', function (Blueprint $table) {
            $table->increments('id');
            //Relacion con la tabla institucion
            $table->integer('institucion_id')->index();
            $table->integer('periodo_id')->index();
            $table->string('tema');
            $table->text('descripcion');
            $table->string('fuente');
            $table->datetime('fecha_reporte');
            $table->string('lugar');
            $table->integer('porcentaje_avance');
            $table->text('lineas_discursivas')->nullable();
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
        Schema::dropIfExists('csp_reportes_hechos');
    }
}
