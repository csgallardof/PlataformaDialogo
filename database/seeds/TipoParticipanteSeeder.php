<?php

use Illuminate\Database\Seeder;

use App\TipoParticipante;

class TipoParticipanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Borramos los datos de la tabla
        DB::table('tipo_participante')->delete();

        // Añadimos una entrada a esta tabla
        TipoParticipante::create(array('nombre' => 'Público'));
        TipoParticipante::create(array('nombre' => 'Privado'));
        TipoParticipante::create(array('nombre' => 'EPS'));
        TipoParticipante::create(array('nombre' => 'Artesano'));
    }
}
