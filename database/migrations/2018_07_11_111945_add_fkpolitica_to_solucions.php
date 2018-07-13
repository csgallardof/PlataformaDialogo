<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkpoliticaToSolucions extends Migration
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
            $table->integer('politica_id')->unsigned()->nullable();
            $table->foreign('politica_id')->references('id')->on('politicas');
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
            $table->dropForeign('solucions_politica_id_foreign');
            $table->dropColumn('politica_id');
        });

    }
}
