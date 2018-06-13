<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Illuminate\Support\Collection as Collection;
use DB;

class ReportePublicoController extends Controller {
    /* Listar Propuestas(soluciones) por el estado (Desarrollo, Finalizado, Analizado )
      Suma total de estados de soluciones
     */

    public function listaReportes() {
        /* Reporte por estados de soluciones */
        $solicitud = DB::select("SELECT e.nombre_estado estados , count(s.id) total   FROM solucions s 
inner join estado_solucion e On e.id= s.estado_id
group by s.estado_id");
        $solicitud = Collection::make($solicitud);

        /* Reporte por mesa */
        $mesa = DB::select("SELECT 
  e.nombre_estado estados, count(s.id) total  
FROM solucions s 
inner join estado_solucion e On e.id= s.estado_id
inner join mesa_dialogo m On m.id = s.mesa_id 
group by e.nombre_estado");
        $mesa = Collection::make($mesa);

        /* Reporte por zona */
        $zona = DB::select("SELECT 
 z.nombre zonas, e.nombre_estado estados, count(s.id) total
FROM solucions s 
inner join estado_solucion e On e.id= s.estado_id
inner join mesa_dialogo m On m.id = s.mesa_id 
inner join zona z On z.id = m.zona_id 
group by e.nombre_estado,  z.nombre");
        $zona = Collection::make($zona);


        /* Reporte por institucion */
        $institucion = DB::select("SELECT 
i.nombre_institucion instituciones, e.nombre_estado estados, count(s.id) 'Total'  
FROM solucions s 
inner join estado_solucion e On e.id= s.estado_id
inner join mesa_dialogo m On m.id = s.mesa_id 
inner join institucions i On i.id = m.organizador_id
group by e.nombre_estado,  i.nombre_institucion");
        $institucion = Collection::make($institucion);


        /* Reporte por plazo */
        $plazo = DB::select("
SELECT 
 s.plazo_cumplimiento plazo, count(s.id) total 
FROM solucions s 
inner join estado_solucion e On e.id= s.estado_id
group by   s.plazo_cumplimiento
");
        $plazo = Collection::make($plazo);

        /* Reporte por plazo */
        $actividad = DB::select("SELECT 
s.problema_solucion, 
i.nombre_institucion instituciones, 
e.nombre_estado estados, 
(select sum(a.id) from actividades a where a.solucion_id=s.id) actividades
FROM solucions s
inner join estado_solucion e On e.id= s.estado_id
inner join mesa_dialogo m On m.id = s.mesa_id 
inner join institucions i On i.id = m.organizador_id
");
        $actividad = Collection::make($actividad);



        return view("publico.reporte.reporteGeneral")->with(["solicitud" => $solicitud,
        "mesa" => $mesa,
        "institucion" => $institucion,
        "zona" => $zona,
        "actividad" => $actividad,
        "plazo" => $plazo]);
    }

}
