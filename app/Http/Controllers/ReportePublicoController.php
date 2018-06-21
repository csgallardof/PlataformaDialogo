<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Illuminate\Support\Collection as Collection;
use App\Institucion;
use App\ConsejoSectorial;
use App\EstadoSolucion;
use App\Zona;
use App\MesaDialogo;
use DB;

class ReportePublicoController extends Controller {
/* Listar Propuestas(soluciones) por el estado (Desarrollo, Finalizado, Analizado )
  Suma total de estados de soluciones
 */

public function listaReportes(Request $request) {
    
    //variables 
    
    
    $institucion_id= $request->get('institucion_id');
    $consejoSectorial_id= $request->get('consejoSectorial_id');
    $estado_id= $request->get('estado_id');
    $zona_id= $request->get('zona_id');
    $mesaDialogo_id= $request->get('mesa_id');
    $palabra_clave= $request->get('palabra_clave');
    
    $i="";$cs="";$e="";$m="";$z="";$pc="";
    if(($institucion_id != -1)&&($institucion_id!='') ){$i=" and i.id in ($institucion_id) ";}
    if(($consejoSectorial_id!=-1)&&($consejoSectorial_id!='')){$cs=" and  cs.id in ($consejoSectorial_id) ";}
    if(($estado_id!=-1)&&($estado_id!='')){$e="  and e.id in ($estado_id) ";}
    if(($zona_id!=-1)&&($zona_id!='')){$z=" and  z.id in ($zona_id) ";}
    if(($mesaDialogo_id!=-1)&&($mesaDialogo_id!='')){$m=" and  m.id in ($mesaDialogo_id) ";}
    if(($palabra_clave!=-1)&&($palabra_clave!='')){$pc=" i.id ilike (%$palabra_clave%) ";}
    
    
    
    //echo " $i  $institucion_id - $consejoSectorial_id - $estado_id - $zona_id - $mesaDialogo_id -  $palabra_clave ";
    
    $case="  
CASE e.id  WHEN 1 THEN 1 ELSE 0 END  Analisis,
CASE e.id  WHEN 3 THEN 1 ELSE 0 END  Desarrollo,
CASE e.id  WHEN 4 THEN 1 ELSE 0 END  Finalizado";
    
    $institucion_ = Institucion::all();
    $consejoSectorial_= ConsejoSectorial::all();
    $estado_= EstadoSolucion::all();
    $zona_= Zona::all();
    $mesaDialogo_= MesaDialogo::all();
 
    $institucion_id= $request->get('institucion_id'); 
    //echo $institucion_id;
    
/* Reporte por estados de soluciones */
$solicitud = DB::select("select nombre  ,count(Analisis)analisis,
sum(Desarrollo) desarrollo,sum(Finalizado) finalizado from 
(SELECT cs.nombre_consejo nombre,
$case
   FROM solucions s
inner join estado_solucion e On e.id= s.estado_id
inner join mesa_dialogo m On m.id = s.mesa_id 
inner join consejo_sectorials cs On cs.id= m.consejo_sectorial_id
where cs.id > 0 $cs $e $m
) solictud 
 group by nombre;");
$solicitud = Collection::make($solicitud);

/* Reporte por mesa */
$mesa = DB::select("select nombre  ,count(Analisis)analisis,
sum(Desarrollo) desarrollo,sum(Finalizado) finalizado from 
(SELECT m.nombre nombre,
$case
   FROM solucions s
inner join estado_solucion e On e.id= s.estado_id
inner join mesa_dialogo m On m.id = s.mesa_id 
where m.id > 0 $m $e
) solictud 
group by nombre");
$mesa = Collection::make($mesa);

/* Reporte por zona */
$zona = DB::select(" select nombre  ,count(Analisis)analisis,
sum(Desarrollo) desarrollo,sum(Finalizado) finalizado from 
(SELECT z.nombre nombre,
$case
   FROM solucions s
inner join estado_solucion e On e.id= s.estado_id
inner join mesa_dialogo m On m.id = s.mesa_id 
inner join zona z On z.id = m.zona_id 
where m.id > 0 $m $z $e
) solictud 
group by nombre;
");
$zona = Collection::make($zona);


/* Reporte por institucion */
$institucion = DB::select(" 
select nombre  ,count(Analisis)analisis,
sum(Desarrollo) desarrollo,sum(Finalizado) finalizado from 
(SELECT  i.nombre_institucion  nombre,
$case
   FROM solucions s
inner join estado_solucion e On e.id= s.estado_id
inner join mesa_dialogo m On m.id = s.mesa_id 
inner join institucions i On i.id = m.organizador_id
where m.id > 0 $m $e $i
) solictud
group by nombre;
");
$institucion = Collection::make($institucion);


/* Reporte por plazo */
$plazo = DB::select("
SELECT 
 s.plazo_cumplimiento plazo, count(s.id) total 
FROM solucions s 
inner join estado_solucion e On e.id= s.estado_id
where e.id > 0 $e
group by   s.plazo_cumplimiento
");
$plazo = Collection::make($plazo);

/* Reporte por plazo */
$actividad = DB::select("select consejo, institucion  ,count(Analisis)analisis,
sum(Desarrollo) desarrollo,sum(Finalizado) finalizado , actividad from 
(SELECT 
cs.nombre_consejo consejo ,
i.nombre_institucion institucion, 
$case,
CASE (select sum(a.id) from actividades a where a.solucion_id=s.id) WHEN null THEN (select sum(a.id) from actividades a where a.solucion_id=s.id) ELSE 0 END actividad
FROM solucions s
inner join estado_solucion e On e.id= s.estado_id
inner join mesa_dialogo m On m.id = s.mesa_id 
inner join institucions i On i.id = m.organizador_id
inner join consejo_sectorials cs On cs.id= m.consejo_sectorial_id
where e.id > 0 $cs $e $i $m
) solicitud
");
$actividad = Collection::make($actividad);

return view("publico.reporte.reporteGeneral")->with(["solicitud" => $solicitud,
 "mesa" => $mesa,
 "institucion" => $institucion,
 "zona" => $zona,
 "actividad" => $actividad,
 "plazo" => $plazo,
        "institucion_"=>$institucion_,"consejoSectorial_" =>$consejoSectorial_,
        "estado_" =>$estado_,"zona_" =>$zona_ 
        ,"mesaDialogo_" =>$mesaDialogo_ ]);
}

}
