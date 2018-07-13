<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkindiceToSolucions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('solucions', function($table) {
            $table->integer('indice_competitividad_id')->unsigned()->nullable();
            $table->foreign('indice_competitividad_id')->references('id')->on('indice_competitividads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('solucions', function($table) {
            $table->dropForeign('solucions_indice_competitividad_id_foreign');
            $table->dropColumn('indice_competitividad_id'); 
        });
    }
}
