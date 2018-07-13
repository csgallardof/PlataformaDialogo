<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanNacionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_nacionals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_plan_nacional')->comment="nombre del plan nacional";
            $table->string('detalle_plan_nacional')->comment="nombre del plan nacional";
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_nacionals');
    }
}
