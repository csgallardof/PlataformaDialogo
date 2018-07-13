<?php

use Illuminate\Database\Seeder;
use App\Politica;

class PoliticaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('politicas')->delete();

        // Añadimos una entrada a esta tabla
        Politica::create(array('nombre_politica' => 'Social'));
        Politica::create(array('nombre_politica' => 'Productivo'));
    }
}
