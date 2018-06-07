<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropSolucionIdInUserEventoSolucionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('user_evento_solucion', function (Blueprint $table) {
            
            $table->dropColumn('solucion_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_evento_solucion', function (Blueprint $table) {
            
            $table->integer('solucion_id');
            
        });
    }
}
