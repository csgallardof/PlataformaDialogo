<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTipoEmpresaIdToSolucionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solucions', function (Blueprint $table) {
            
            // inicio de relaciones 

            $table->integer('tipo_empresa_id');;
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
            
            $table->dropColumn('tipo_empresa_id');
        });
    }
}
