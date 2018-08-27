<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Solucion;
use App\Actividad;
use DB;
use Illuminate\Support\Collection as Collection;

class PdfController extends Controller
{
    public function exportarPropuestasDialogoNacional(Request $request,$tipo){

        $vistaurl="publico.reportes.pdfReportes.pdfPropuestasDialogoNacional";

        $cheches = $request['check']; 
            $check="";
     
        for ($i=0; $i <count($cheches) ; $i++) { 
            $check .= $cheches[$i].",";
        }
        $consulta=substr($check,0,-1); 
        //dd($consulta,'hola');
        $solucion=DB::select("SELECT solucions.*, estado_solucion.nombre_estado, institucions.nombre_institucion FROM solucions
            JOIN estado_solucion ON estado_solucion.id=solucions.estado_id
            LEFT JOIN actor_solucion on actor_solucion.solucion_id = solucions.id
            LEFT JOIN institucions on institucions.id = actor_solucion.institucion_id  
            WHERE solucions.id in ($consulta) "); 
        //dd($agendaTerritorialMAP);
        $solucion=Collection::make($solucion);
        //dd($solucion);
        return $this->crearDialogoNacionalPDF($solucion, $vistaurl,$tipo);

    }

    public function crearDialogoNacionalPDF($dato1,$vistaurl,$tipo)
    {
        
        $data1 = $dato1;
        //dd($data1);
        
        //$elementos= sizeof($data1);
        //dd($data1);
        $date = date('Y-m-d');
        $view = \View::make($vistaurl, compact('date'))->with(["data1"=>$data1]);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        
        if($tipo==1){return $pdf->stream('DialogoNacional.pdf');}
        if($tipo==2){return $pdf->download('DialogoNacional.pdf'); }
    }



    public function crearReportePropuestaDetallada($idPropuesta,$tipo){

     //dd($idSolucion,$tipo);
        //dd($periodo_reporte);
     $vistaurl="publico.reportes.pdfReportes.pdfPropuestaDetallada";
    
        $estado_solucion = DB::table('solucions')->where('id', $idPropuesta)->first();
            if ($estado_solucion->estado_id==1) {
                //dd('estoy aki');
                $solucion = DB::table('solucions')  ->join('estado_solucion','estado_solucion.id', '=','solucions.estado_id')
                                                    ->where('solucions.id', $idPropuesta)
                                                    ->select('solucions.*','estado_solucion.nombre_estado')
                                                    ->first();

                //dd($solucion);
            }else{
            
            

			$solucion= DB::table('solucions')->leftJoin('actividades', 'actividades.solucion_id', '=', 'solucions.id')
											->leftJoin('estado_solucion', 'estado_solucion.id', '=', 'solucions.estado_id')
											->leftJoin('actor_solucion', 'actor_solucion.solucion_id', '=', 'solucions.id')
											->leftJoin('institucions', 'institucions.id', '=', 'actor_solucion.institucion_id')
											->WHERE('solucions.id','=', $idPropuesta)
											->Where('actor_solucion.tipo_actor','=', 1)		
											->select('solucions.*','estado_solucion.nombre_estado','institucions.nombre_institucion')
											->selectRAW('GROUP_CONCAT(actividades.comentario) as actividades')
											->groupBy('solucions.id')
											->first();
			//dd($solucion);
       		}

        return $this->crearPDF($solucion, $vistaurl,$tipo);
    }

    public function crearPDF($dato1,$vistaurl,$tipo)
    {
        
        $data1 = $dato1;
        //dd($data1);
        
        //$elementos= sizeof($data1);
        //dd($data1);
        $date = date('Y-m-d');
        $view = \View::make($vistaurl, compact('date'))->with(["data1"=>$data1]);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        
        if($tipo==1){return $pdf->stream('PropuestaDestalladaDialogoNacional.pdf');}
        if($tipo==2){return $pdf->download('PropuestaDestalladaDialogoNacional.pdf'); }
    }


    /**
     * Funcion para la generación de un pdf dado un nombre
     * @param $dato1
     * @param $vistaurl
     * @param $tipo
     * @return mixed
     */
    public function crearPDFmod($dato1,$vistaurl,$tipo,$nombrearchivo)
    {

        $data1 = $dato1;

        $date = date('Y-m-d');
        $view = \View::make($vistaurl, compact('date'))->with(["data1"=>$data1]);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        if($tipo==1){return $pdf->stream($nombrearchivo.'.pdf');}
        if($tipo==2){return $pdf->download($nombrearchivo.'.pdf'); }
    }


}
