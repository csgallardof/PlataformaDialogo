<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnasToSolucionsTable extends Migration 
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solucions', function (Blueprint $table) {
            $table->integer('zona_id');
            $table->text('lugar_solucion');
            $table->date('fecha_solucion');
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
            $table->dropColumn('zona_id');
            $table->dropColumn('lugar_solucion');
            $table->dropColumn('fecha_solucion');
        });
    }
}
