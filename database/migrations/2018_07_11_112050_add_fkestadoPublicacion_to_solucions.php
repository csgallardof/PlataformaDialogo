<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkestadoPublicacionToSolucions extends Migration
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
            $table->integer('estado_publicacion_id')->unsigned()->nullable();
            $table->foreign('estado_publicacion_id')->references('id')->on('estado_publicacions');
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
            $table->dropForeign('solucions_estado_publicacio_id_foreign');
            $table->dropColumn('estado_publicacion_id');
        });
    }
}
