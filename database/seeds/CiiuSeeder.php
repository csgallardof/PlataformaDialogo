<?php

use Illuminate\Database\Seeder;
use App\CnCiiu;

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
        DB::table('cn_ciius')->delete();

        // Añadimos una entrada a esta tabla
        CnCiiu::create(array('codigo_ciiu' => '9','actividad_ciiu' => 'Sin actividad económica - ciiu'));
        CnCiiu::create(array('codigo_ciiu' => 'A','actividad_ciiu' => 'Agricultura'));
        CnCiiu::create(array('codigo_ciiu' => 'A','actividad_ciiu' => 'Acuicultura y pesca de camarón'));
        CnCiiu::create(array('codigo_ciiu' => 'A','actividad_ciiu' => 'Pesca y acuicultura (excepto de camarón)'));
        CnCiiu::create(array('codigo_ciiu' => 'A','actividad_ciiu' => 'Agricultura, ganadería, silvicultura y pesca'));
        CnCiiu::create(array('codigo_ciiu' => 'B','actividad_ciiu' => 'Petróleo y minas'));
        CnCiiu::create(array('codigo_ciiu' => 'B','actividad_ciiu' => 'Explotación de minas y canteras'));
        CnCiiu::create(array('codigo_ciiu' => 'C','actividad_ciiu' => 'Industrias manufactureras'));
        CnCiiu::create(array('codigo_ciiu' => 'C-J','actividad_ciiu' => 'Manufactura'));
        CnCiiu::create(array('codigo_ciiu' => 'D','actividad_ciiu' => 'Suministro de electricidad, gas, vapor y aire acondicionado'));
        CnCiiu::create(array('codigo_ciiu' => 'D-E','actividad_ciiu' => 'Suministros de electricidad y agua'));
        CnCiiu::create(array('codigo_ciiu' => 'E','actividad_ciiu' => 'Distrib. de agua; alcantarillado, gestión desechos y activ. saneamiento'));
        CnCiiu::create(array('codigo_ciiu' => 'E','actividad_ciiu' => 'Distribución de agua; alcantarillado, gestión de desechos y actividades de saneamiento.'));
        CnCiiu::create(array('codigo_ciiu' => 'F','actividad_ciiu' => 'Construcción'));
        CnCiiu::create(array('codigo_ciiu' => 'G','actividad_ciiu' => 'Comercio'));
        CnCiiu::create(array('codigo_ciiu' => 'G','actividad_ciiu' => 'Comercio al por mayor y al por menor; reparación de vehículos')); 
        CnCiiu::create(array('codigo_ciiu' => 'G','actividad_ciiu' => 'Comercio al por mayor y al por menor; reparación de vehículos automotores y motocicletas.')); 
        CnCiiu::create(array('codigo_ciiu' => 'H','actividad_ciiu' => 'Transporte'));
        CnCiiu::create(array('codigo_ciiu' => 'H','actividad_ciiu' => 'Transporte y almacenamiento'));
        CnCiiu::create(array('codigo_ciiu' => 'H-J','actividad_ciiu' => 'Correo y Comunicaciones'));
        CnCiiu::create(array('codigo_ciiu' => 'I','actividad_ciiu' => 'Alojamiento y servicios de comida'));
        CnCiiu::create(array('codigo_ciiu' => 'I','actividad_ciiu' => 'Actividades de alojamiento y de servicio de comidas'));
        CnCiiu::create(array('codigo_ciiu' => 'J','actividad_ciiu' => 'Información y comunicación'));
        CnCiiu::create(array('codigo_ciiu' => 'K','actividad_ciiu' => 'Actividades de servicios financieros'));
        CnCiiu::create(array('codigo_ciiu' => 'K','actividad_ciiu' => 'Actividades financieras y de seguros'));
        CnCiiu::create(array('codigo_ciiu' => 'L','actividad_ciiu' => 'Actividades inmobiliarias'));
        CnCiiu::create(array('codigo_ciiu' => 'L-R-S-U','actividad_ciiu' => 'Otros Servicios'));
        CnCiiu::create(array('codigo_ciiu' => 'M','actividad_ciiu' => 'Actividades profesionales, técnicas y administrativas'));
        CnCiiu::create(array('codigo_ciiu' => 'M','actividad_ciiu' => 'Actividades profesionales, científicas y técnicas'));
        CnCiiu::create(array('codigo_ciiu' => 'N','actividad_ciiu' => 'Actividades de servicios administrativos y de apoyo'));
        CnCiiu::create(array('codigo_ciiu' => 'O','actividad_ciiu' => 'Administración pública y defensa; planes de seguridad social de afiliación obligatoria.'));
        CnCiiu::create(array('codigo_ciiu' => 'O','actividad_ciiu' => 'Administración pública, defensa; planes de seguridad social obligatoria'));
        CnCiiu::create(array('codigo_ciiu' => 'O','actividad_ciiu' => 'Administ. pública y defensa; planes de segur. social de afiliación obligat.'));
        CnCiiu::create(array('codigo_ciiu' => 'OEP','actividad_ciiu' => 'Otros elementos del PIB'));
        CnCiiu::create(array('codigo_ciiu' => 'P','actividad_ciiu' => 'Enseñanza'));
        CnCiiu::create(array('codigo_ciiu' => 'P-Q','actividad_ciiu' => 'Enseñanza  y Servicios sociales y de salud'));
        CnCiiu::create(array('codigo_ciiu' => 'Q','actividad_ciiu' => 'Activ.de atención de la salud humana y de asistencia social'));
        CnCiiu::create(array('codigo_ciiu' => 'Q','actividad_ciiu' => 'Actividades de atención de la salud humana y de asistencia social.'));
        CnCiiu::create(array('codigo_ciiu' => 'R','actividad_ciiu' => 'Artes, entretenimiento y recreación'));
        CnCiiu::create(array('codigo_ciiu' => 'S','actividad_ciiu' => 'Otras actividades de servicios'));
        CnCiiu::create(array('codigo_ciiu' => 'T','actividad_ciiu' => 'Actividades de los hogares como empleadores'));
        CnCiiu::create(array('codigo_ciiu' => 'T','actividad_ciiu' => 'Servicio doméstico'));
        CnCiiu::create(array('codigo_ciiu' => 'T','actividad_ciiu' => 'Actividades de los hogares como empleadores; actividades no diferenciadas de los hogares como productores de bienes y servicios para uso propio.'));
        CnCiiu::create(array('codigo_ciiu' => 'U','actividad_ciiu' => 'Actividades de organizaciones y órganos extraterritoriales'));
        CnCiiu::create(array('codigo_ciiu' => 'V-W-X-Z','actividad_ciiu' => 'Sin actividad económica - ciiu'));
         CnCiiu::create(array('codigo_ciiu' => 'V-X-Z-9-W','actividad_ciiu' => 'Sin actividad económica - ciiu'));
        CnCiiu::create(array('codigo_ciiu' => 'V','actividad_ciiu' => 'Sin actividad económica - ciiu'));
        CnCiiu::create(array('codigo_ciiu' => 'W','actividad_ciiu' => 'Sin actividad económica - ciiu'));
        CnCiiu::create(array('codigo_ciiu' => 'X','actividad_ciiu' => 'Sin actividad económica - ciiu'));
        CnCiiu::create(array('codigo_ciiu' => 'Z','actividad_ciiu' => 'Sin actividad económica - ciiu'));
        /*4 DIGITOS*/
        CnCiiu::create(array('codigo_ciiu' => 'C1920','actividad_ciiu' => 'Fabricación de productos de la refinación del petróleo.'));
        CnCiiu::create(array('codigo_ciiu' => 'C1010','actividad_ciiu' => 'Elaboración y conservación de carne.'));
        CnCiiu::create(array('codigo_ciiu' => 'C1050','actividad_ciiu' => 'Elaboración de productos lácteos.'));
        CnCiiu::create(array('codigo_ciiu' => 'C1104','actividad_ciiu' => 'Elaboración de bebidas no alcohólicas; producción de aguas minerales y otras aguas embotelladas.'));
        CnCiiu::create(array('codigo_ciiu' => 'C1040','actividad_ciiu' => 'Elaboración de aceites y grasas de origen vegetal y animal.'));
        CnCiiu::create(array('codigo_ciiu' => 'C1080','actividad_ciiu' => 'Elaboración de alimentos preparados para animales.'));

        
   
        
    }
}
