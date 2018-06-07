<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddApellidoCedulaTelefonoCelularToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            
            $table->string('apellidos');
            $table->string('cedula');
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();;
        
            $table->integer('tipo_fuente');

            // inicio de relaciones 

            $table->integer('sector_id');
            $table->integer('vsector_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            
            $table->dropColumn('apellidos');
            $table->dropColumn('cedula');
            $table->dropColumn('telefono');
            $table->dropColumn('celular');
            
            $table->dropColumn('tipo_fuente');
            $table->dropColumn('sector_id');
            $table->dropColumn('vsector_id');
        });
    }
}
