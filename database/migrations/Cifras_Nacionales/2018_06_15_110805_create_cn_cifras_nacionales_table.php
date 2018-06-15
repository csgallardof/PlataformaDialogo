<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCnCifrasNacionalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cn_cifras_nacionales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_cifra_nacional');
            $table->integer('año');
            $table->string('valor');

            /*RELACION CON LA TABLA TIPOIMPUESTO*/
            $table->integer('tipo_impuesto_id')->unsigned();
            $table->foreign('tipo_impuesto_id')->references('id')->on('cn_tipo_impuestos')->onDelete('cascade');
            
            /*RELACION CON LA TABLA TIPOCIFRANACIONAL*/
            $table->integer('tipo_cifra_nacional_id')->unsigned();
            $table->foreign('tipo_cifra_nacional_id')->references('id')->on('cn_tipo_cifra_nacionals')->onDelete('cascade');
            
            /*RELACION CON LA TABLA TIPOEMPRESAS*/
            $table->integer('tipo_empresa_id')->unsigned();
            $table->foreign('tipo_empresa_id')->references('id')->on('cn_tipo_empresas')->onDelete('cascade');

            /*RELACION CON LA TABLA PROVINCIA*/
            $table->integer('provincia_id')->unsigned();
            $table->foreign('provincia_id')->references('id')->on('cn_provincias')->onDelete('cascade');

            /*RELACION CON LA TABLA CIIU*/
            $table->integer('ciiu_id')->unsigned();
            $table->foreign('ciiu_id')->references('id')->on('cn_ciius')->onDelete('cascade');

            /*RELACION CON LA TABLA TIPO FUENTE*/
            $table->integer('tipo_fuente_id')->unsigned();
            $table->foreign('tipo_fuente_id')->references('id')->on('cn_tipo_fuentes')->onDelete('cascade');

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
        Schema::dropIfExists('cn_cifras_nacionales');
    }
}
