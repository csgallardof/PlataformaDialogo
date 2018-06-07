<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdMesaToSolucionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solucions', function (Blueprint $table) {
            
            // inicio de relaciones 
            $table->string('corresponsable_solucion')->nullable()->change();
            $table->text('solucion_ccpt');
            $table->integer('mesa_id');
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
            
            $table->dropColumn('mesa_id');
            $table->dropColumn('solucion_ccpt');
        });   
    }
}
