<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolucionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solucions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('problema_solucion');
            $table->text('problema_validar_solucion');
            $table->string('verbo_solucion');
            $table->string('sujeto_solucion');
            $table->text('complemento_solucion');
            $table->string('coordinador_zonal_solucion');
            $table->string('responsable_solucion');
            $table->string('corresponsable_solucion');
            $table->string('sistematizador_solucion');
            $table->string('lider_mesa_solucion');
            $table->integer('tipo_fuente');
            

            // inicio de relaciones 

            
            $table->integer('ambit_id');
            $table->integer('evento_id');
            $table->integer('instrumento_id');
            $table->integer('pajustada_id');
            $table->integer('provincia_id');
            $table->integer('sector_id');
            $table->integer('sipoc_id');
            $table->integer('thematic_id');
            $table->integer('vsector_id');
            
            //Nuevos Campos para definir los parametros de cumplimiento de la propuesta
            $table->date('fecha_cumplimimento');
            $table->string('plazo_cumplimiento');
            $table->text('riesgos_cumplimiento');
            $table->string('supuestos_cumplimientos');
            




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
        Schema::dropIfExists('solucions');
    }
}
