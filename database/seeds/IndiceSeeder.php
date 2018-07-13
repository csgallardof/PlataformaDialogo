<?php

use Illuminate\Database\Seeder;
use App\IndiceCompetitividad;

class IndiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Borramos los datos de la tabla
        DB::table('indice_competitividads')->delete();

        // Añadimos una entrada a esta tabla
        IndiceCompetitividad::create(array('nombre_indice_competitividad' => 'Desarrollo Integral de las personas', 
        							'descripcion_indice_competitividad' => '(6 Indicadores) Supone que a mayor educación, menor pobreza y menor mortalidad más competitividad' ));
        IndiceCompetitividad::create(array('nombre_indice_competitividad' => 'Desempeño Económico', 
        							'descripcion_indice_competitividad' => '( 9 indicadores) A mayor producción, mayor valor agregado, menor concentración y menor desigualdad; mayor competitividad' ));
        IndiceCompetitividad::create(array('nombre_indice_competitividad' => 'Empleo', 
        							'descripcion_indice_competitividad' => '(4 indicadores) A más empleo, y menor desempleo; mayor competitividad' ));
       	IndiceCompetitividad::create(array('nombre_indice_competitividad' => 'Gestión Empresarial', 
        							'descripcion_indice_competitividad' => '(4 indicadores) A mayor cantidad de activos , empresas, industrias y Pymes; mayor competitividad provincial' ));
       	IndiceCompetitividad::create(array('nombre_indice_competitividad' => 'Infraestructura y Localización', 
        							'descripcion_indice_competitividad' => 'A mayor cobertura de telefonía, mayor cantidad de vías asfaltadas , menor distancia a puertos y aeropuertos; mayor competitividad' ));
       	IndiceCompetitividad::create(array('nombre_indice_competitividad' => 'Seguridad Jurídica', 
        							'descripcion_indice_competitividad' => 'A mayor capacidad de recursos físicos y de personal; y menor cantidad de delitos ; mayor competitividad.' ));
       	IndiceCompetitividad::create(array('nombre_indice_competitividad' => 'Internacionalización y Apertura', 
        							'descripcion_indice_competitividad' => 'A mayor capacidad exportadora e inversión mayor competitividad' ));
       	IndiceCompetitividad::create(array('nombre_indice_competitividad' => 'Gestión, Gobiernos e Instituciones', 
        							'descripcion_indice_competitividad' => 'A mayor capacidad de recursos físicos y de personal; y menor cantidad de delitos ; mayor competitividad.' ));
       	IndiceCompetitividad::create(array('nombre_indice_competitividad' => 'Mercados Financieros', 
        							'descripcion_indice_competitividad' => 'A mayor cantidad de recursos colocados y desembolsados, menor nivel de morosidad y mayor cobertura con sucursales bancarias; mejor competitividad.' ));
       	IndiceCompetitividad::create(array('nombre_indice_competitividad' => 'Recursos Naturales y Ambiente', 
        							'descripcion_indice_competitividad' => 'A mayor cantidad de recursos naturales mayor competitividad.' ));
       	IndiceCompetitividad::create(array('nombre_indice_competitividad' => 'Habilitantes de Innovación, Ciencia y Tecnología', 
        							'descripcion_indice_competitividad' => 'Mientras más profesionales, cobertura de internet, telefonía celular y número de universidades y carreras universitarias, mayor competitividad' ));


        
    }
}
