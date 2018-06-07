<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCspAgendaTerritorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csp_agenda_territorials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('institucion_id')->index();
            $table->integer('canton_id')->index();
            $table->string('lugar');
            $table->integer('tipo_agenda_id')->index();
            $table->integer('tipo_impacto_id')->index();
            $table->integer('periodo_agenda_id')->index();
            $table->text('descripcion_tipo_agenda');

            $table->text('descripcion_tipo_impacto');
            $table->string('responsable');
            $table->datetime('fecha_agenda');
            $table->string('tipo_comunicacional');
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
        Schema::dropIfExists('csp_agenda_territorials');
    }
}
