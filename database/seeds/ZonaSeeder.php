<?php

use Illuminate\Database\Seeder;
use App\Zona;

class ZonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // Borramos los datos de la tabla
        DB::table('zona')->delete();

        // Añadimos una entrada a esta tabla
        Zona::create(array('nombre' => 'Zona de Planificación 1 – Norte','descripcion' => 'Esmeraldas, Carchi, Imbabura, Sucumbíos'));
        Zona::create(array('nombre' => 'Zona de Planificación 2 – Centro Norte','descripcion' => 'Pichincha (excepto el Distrito Metropolitano), Napo, Orellana'));
        Zona::create(array('nombre' => 'Zona de Planificación 3 – Centro','descripcion' => 'Cotopaxi, Chimborazo, Pastaza, Tungurahua'));
        Zona::create(array('nombre' => 'Zona de Planificación 4 – Pacífico','descripcion' => 'Manabí, Santo Domingo de Los Tsáchilas'));
        Zona::create(array('nombre' => 'Zona de Planificación 5 – Litoral','descripcion' => 'Guayas (excepto los cantones de Guayaquil, Samborondón y Duran), Los Ríos, Santa Elena, Bolívar, Galápagos'));
        Zona::create(array('nombre' => 'Zona de Planificación 6 – Austro','descripcion' => 'Azuay, Cañar, Morona Santiago'));
        Zona::create(array('nombre' => 'Zona de Planificación 7 – Sur','descripcion' => 'El Oro, Loja, Zamora Chinchipe'));
        Zona::create(array('nombre' => 'Zona de Planificación 8','descripcion' => 'Guayaquil, Durán, Sanboromdon'));
        Zona::create(array('nombre' => 'Zona de Planificación 9','descripcion' => 'Distrito Metropolitano de Quito'));
        Zona::create(array('nombre' => 'Exterior','descripcion' => 'Africa, Europa, Asia, Oceania, America'));
        Zona::create(array('nombre' => 'S/D','descripcion' => 'No identifica'));

    }
}
