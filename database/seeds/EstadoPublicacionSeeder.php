<?php

use Illuminate\Database\Seeder;
use App\EstadoPublicacion;

class EstadoPublicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('estado_publicacions')->delete();

        // Añadimos una entrada a esta tabla
        EstadoPublicacion::create(array('nombre_estado_publicacions' => 'Publicar' ));
        EstadoPublicacion::create(array('nombre_estado_publicacions' => 'Borrador' ));
        EstadoPublicacion::create(array('nombre_estado_publicacions' => 'Privado' ));
    }
}
