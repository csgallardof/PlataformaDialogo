<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInstitucionIdToActorSolucion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('actor_solucion', function (Blueprint $table) {
            $table->integer('institucion_id')->after('user_id');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('actor_solucion', function (Blueprint $table) {
            $table->dropColumn('institucion_id');
           
        });
    }
}
