<?php

use Illuminate\Database\Seeder;
use App\TipoDialogo;

class TipoDialogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Borramos los datos de la tabla
        DB::table('tipo_dialogo')->delete();

        // Añadimos una entrada a esta tabla
        TipoDialogo::create(array('nombre' => 'Presidente'));
        TipoDialogo::create(array('nombre' => 'Sectorial'));
        TipoDialogo::create(array('nombre' => 'Productivo'));
    }
}
