<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkplannacionalToSolucions extends Migration
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
            $table->integer('plan_nacional_id')->unsigned()->nullable();
            $table->foreign('plan_nacional_id')->references('id')->on('plan_nacionals');
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
            $table->dropForeign('plan_naciona_id_foreign');
            $table->dropColumn('plan_nacional_id');
        });
    }
}
