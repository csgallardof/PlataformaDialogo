<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMesaDialogoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesa_dialogo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->comment = "Nombre de la mesa de dialogo";

            $table->integer('tipo_dialogo_id')->unsigned();
            $table->foreign('tipo_dialogo_id')->references('id')->on('tipo_dialogo');
            $table->integer('organizador_id')->unsigned();
            $table->foreign('organizador_id')->references('id')->on('institucions');

            $table->integer('consejo_sectorial_id')->unsigned()->nullable();
            $table->foreign('consejo_sectorial_id')->references('id')->on('institucions');

            $table->string('lider')->nullable()->comment = "Líder de la mesa de dialogo";
            $table->string('coordinador')->nullable()->comment = "Coordinador u Funcionario Zonal Responsable";
            $table->string('sistematizador')->nullable()->comment = "Sistematizador(es), separadas por coma";

            $table->integer('zona_id')->unsigned()->nullable();
            $table->foreign('zona_id')->references('id')->on('zona');

            $table->integer('provincia_id')->unsigned()->nullable();
            $table->foreign('provincia_id')->references('id')->on('provincias');

            $table->integer('canton_id')->unsigned()->nullable();
            $table->foreign('canton_id')->references('id')->on('cantons');

            $table->integer('parroquia_id')->unsigned()->nullable();
            $table->foreign('parroquia_id')->references('id')->on('parroquia');

            $table->string('lugar')->comment = "Lugar donde se lleva a cabo la mesa de dialogo";
            $table->string('organizacion')->nullable()->comment = "Organización o Grupo con quien se da el diálogo";
            $table->timestamp('fecha');

            $table->integer('sector_id')->unsigned()->nullable();
            $table->foreign('sector_id')->references('id')->on('sectors');

            $table->text('descripcion')->nullable()->comment = "Descripción de la mesa de dialogo";

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('mesa_dialogo');
    }
}
