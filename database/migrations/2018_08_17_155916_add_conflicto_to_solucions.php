<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConflictoToSolucions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::table('solucions', function (Blueprint $table) {
            $table->boolean('conflicto')->comment="propuesta en conflicto";
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
        Schema::table('solucions', function (Blueprint $table) {
            $table->dropColumn('conflicto');
            //
        });
    }
}
