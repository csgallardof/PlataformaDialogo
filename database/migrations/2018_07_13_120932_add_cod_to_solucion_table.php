<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCodToSolucionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solucions', function (Blueprint $table) {
            $table->string('cod_solucions')->comment="codigo solucions";
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
            $table->dropColumn('cod_solucions');
            //
        });
    }
}
