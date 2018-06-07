<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsejoInstitucionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consejo_institucions', function (Blueprint $table) {
            $table->increments('id');


            $table->integer('consejo_id')->unsigned()->index();
            $table->foreign('consejo_id')->references('id')->on('consejo_sectorials')->onDelete('cascade');

            $table->integer('institucion_id')->unsigned()->index();
            $table->foreign('institucion_id')->references('id')->on('institucions')->onDelete('cascade');

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
        Schema::dropIfExists('consejo_institucions');
    }
}
