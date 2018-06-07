<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPropuestaSolucionPajustadaPalabrasClaveToSolucionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solucions', function (Blueprint $table) {
            
            $table->text('propuesta_solucion')->nullable()->comment = "Propuesta solución";
            $table->text('pajustada')->nullable()->comment = "Propuesta ajustada";
            $table->text('palabras_clave')->nullable()->comment = "Palabras clave relacionadas a la propuesta, separadas por comas";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solucions', function (Blueprint $table) {
            
            $table->dropColumn('propuesta_solucion');
            $table->dropColumn('pajustada');
            $table->dropColumn('palabras_clave');
            
        }); 
    }
}
