<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCnPoblacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cn_poblacions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_categoria');
            $table->string('tipo_sexo');
            $table->string('tipo_area_geografica');
            $table->integer('año');
            $table->integer('poblacion_economicamente_inactiva');
            $table->integer('poblacion_economicamente_activa');
            $table->integer('poblacion_desempleado');
            $table->integer('poblacion_empleado');
            $table->integer('poblacion_subempleado');
            $table->string('tasa_empleo');
            $table->string('tasa_desempleo');

            /*RELACION CON LA TABLA TIPO FUENTE*/
            $table->integer('tipo_fuente_id')->unsigned();
            $table->foreign('tipo_fuente_id')->references('id')->on('cn_tipo_fuentes')->onDelete('cascade');

            /*RELACION CON LA TABLA PROVINCIA*/
            $table->integer('provincia_id')->unsigned();
            $table->foreign('provincia_id')->references('id')->on('cn_provincias')->onDelete('cascade');

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
        Schema::dropIfExists('cn_poblacions');
    }
}
