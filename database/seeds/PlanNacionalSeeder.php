<?php

use Illuminate\Database\Seeder;
use App\PlanNacional;

class PlanNacionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('plan_nacionals')->delete();

        // Añadimos una entrada a esta tabla
        PlanNacional::create(array('nombre_plan_nacional' => 'Social', 'detalle_plan_nacional' => 'descripcion Social' ));
        PlanNacional::create(array('nombre_plan_nacional' => 'Productivo','detalle_plan_nacional' => 'descripcion productivo' ));
    }
}
