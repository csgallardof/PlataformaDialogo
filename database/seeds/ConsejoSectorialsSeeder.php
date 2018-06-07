<?php

use Illuminate\Database\Seeder;
use App\ConsejoSectorial;

class ConsejoSectorialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	// Borramos los datos de la tabla
        DB::table('consejo_sectorials')->delete();

        // Añadimos una entrada a esta tabla
        ConsejoSectorial::create(array('nombre_consejo' => 'Consejo Sectorial Social'));
        ConsejoSectorial::create(array('nombre_consejo' => 'Consejo Sectorial de Economía'));
        ConsejoSectorial::create(array('nombre_consejo' => 'Consejo Sectorial de Recursos Naturales No Renovables'));
        ConsejoSectorial::create(array('nombre_consejo' => 'Consejo Sectorial de Política Exterior y Promoción'));
        ConsejoSectorial::create(array('nombre_consejo' => 'Consejo Sectorial de Seguridad'));
        ConsejoSectorial::create(array('nombre_consejo' => 'Consejo Sectorial de Hábitat y Ambiente'));

    }
}
