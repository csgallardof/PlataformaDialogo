<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participante', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mesa_dialogo_id')->unsigned();
            $table->foreign('mesa_dialogo_id')->references('id')->on('mesa_dialogo');
            $table->string('nombres')->comment = "Nombres del participante";
            $table->string('apellidos')->comment = "Apellidos del participante";
            $table->string('email');
            $table->string('celular')->nullable();
            $table->string('telefono_ext')->nullable();

            $table->integer('sector_id')->unsigned()->nullable()->comment = "Sector o grupo en el que participará";
            $table->foreign('sector_id')->references('id')->on('sectors');
            $table->integer('tipo_participante_id')->unsigned()->nullable();
            $table->foreign('tipo_participante_id')->references('id')->on('tipo_participante');

            $table->timestamp('empresa')->nullable()->comment = "Empresa u organización";            
            $table->string('cargo')->nullable()->comment = "Cargo que ocupa el participante en la empresa";
            
            $table->integer('sector_empresa_id')->unsigned()->nullable()->comment = "Sector o grupo en el que trabaja la empresa";
            $table->foreign('sector_empresa_id')->references('id')->on('sectors');

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
        Schema::dropIfExists('participante');
    }
}
