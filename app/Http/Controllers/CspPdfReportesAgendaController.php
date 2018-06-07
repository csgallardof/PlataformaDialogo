<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Collection as Collection;
use Laracasts\Flash\Flash;
use DB;
use DateTime; 
class CspPdfReportesAgendaController extends Controller
{ 
    public function listaAgendaTerritorialCsp(){
    	$usuario_institucion_id = Auth::user()->institucion_id;
    	$agendaTerritorial = DB::table('csp_agenda_territorials')
        ->join('csp_periodo_agendas','csp_periodo_agendas.id', '=','csp_agenda_territorials.periodo_agenda_id')
        ->join('cantons','cantons.id', '=','csp_agenda_territorials.canton_id')
        ->join('provincias','provincias.id', '=','cantons.provincia_id')
        ->join('csp_tipo_agendas','csp_tipo_agendas.id', '=','csp_agenda_territorials.tipo_agenda_id')
        ->join('csp_tipo_impacto_agendas','csp_tipo_impacto_agendas.id', '=','csp_agenda_territorials.tipo_agenda_id')
        ->join('institucions','institucions.id', '=','csp_agenda_territorials.institucion_id')
        ->select('csp_agenda_territorials.fecha_agenda','csp_agenda_territorials.lugar','csp_agenda_territorials.id','csp_agenda_territorials.tipo_comunicacional','csp_agenda_territorials.responsable','csp_agenda_territorials.descripcion_tipo_agenda','csp_agenda_territorials.descripcion_tipo_impacto','cantons.nombre_canton','institucions.siglas_institucion as Institucion','provincias.nombre_provincia','csp_periodo_agendas.mes','csp_periodo_agendas.semana_anio','csp_agenda_territorials.created_at as FechaRegistro','csp_tipo_agendas.nombre_tipo_agenda as TipoAgenda','csp_tipo_impacto_agendas.nombre_impacto as ImpactoAgenda')
        ->orderBy('csp_agenda_territorials.id','DESC')
        ->get();

       
        return view('csp.cspAgendaTerritorial.PdfReportes.listaPDFAgendaTerritorial')->with(["agendaTerritorial"=>$agendaTerritorial]);
    }
    public function crearReporteAgendaTerritorial(Request $request,$tipo){
        if(is_null($request['check'])){
        Flash::error("Recuerde seleccionar uno o mas Registros");
        return redirect('/institucion/reportes-lineas-discursivas-csp');

     }else
        //dd($periodo_reporte);
     $vistaurl="csp.cspAgendaTerritorial.PdfReportes.pdfAgendaTerritorial";
     
     $cheches = $request['check'];
     $check="";
     
    	for ($i=0; $i <count($cheches) ; $i++) { 
            $check .= $cheches[$i].",";
        }
        $consulta=substr($check,0,-1); 
        //dd($consulta);
        $agendaTerritorialSem1=DB::select("SELECT csp_agenda_territorials.id, csp_agenda_territorials.fecha_agenda,csp_agenda_territorials.tipo_comunicacional,csp_agenda_territorials.responsable,csp_agenda_territorials.descripcion_tipo_agenda,csp_agenda_territorials.descripcion_tipo_impacto,institucions.siglas_institucion as Institucion,csp_periodo_agendas.semana,csp_agenda_territorials.created_at as FechaRegistro,csp_tipo_agendas.nombre_tipo_agenda as TipoAgenda,csp_tipo_impacto_agendas.nombre_impacto as ImpactoAgenda, cantons.nombre_canton FROM csp_agenda_territorials
			JOIN csp_periodo_agendas ON csp_periodo_agendas.id=csp_agenda_territorials.periodo_agenda_id
			JOIN csp_tipo_agendas ON csp_tipo_agendas.id=csp_agenda_territorials.tipo_agenda_id
			JOIN csp_tipo_impacto_agendas ON csp_tipo_impacto_agendas.id=csp_agenda_territorials.tipo_impacto_id
			JOIN institucions ON institucions.id=csp_agenda_territorials.institucion_id
            JOIN cantons ON cantons.id=csp_agenda_territorials.canton_id
			WHERE csp_agenda_territorials.id in ($consulta) and csp_periodo_agendas.semana='Semana 1'"); 
        //dd($agendaTerritorialMAP);
        $agendaTerritorialSem1=Collection::make($agendaTerritorialSem1);
        //dd($agendaTerritorialSem1);

        $agendaTerritorialSem2=DB::select("SELECT csp_agenda_territorials.id, csp_agenda_territorials.fecha_agenda,csp_agenda_territorials.tipo_comunicacional,csp_agenda_territorials.responsable,csp_agenda_territorials.descripcion_tipo_agenda,csp_agenda_territorials.descripcion_tipo_impacto,institucions.siglas_institucion as Institucion,csp_periodo_agendas.semana,csp_agenda_territorials.created_at as FechaRegistro,csp_tipo_agendas.nombre_tipo_agenda as TipoAgenda,csp_tipo_impacto_agendas.nombre_impacto as ImpactoAgenda, cantons.nombre_canton FROM csp_agenda_territorials
            JOIN csp_periodo_agendas ON csp_periodo_agendas.id=csp_agenda_territorials.periodo_agenda_id
            JOIN csp_tipo_agendas ON csp_tipo_agendas.id=csp_agenda_territorials.tipo_agenda_id
            JOIN csp_tipo_impacto_agendas ON csp_tipo_impacto_agendas.id=csp_agenda_territorials.tipo_impacto_id
            JOIN institucions ON institucions.id=csp_agenda_territorials.institucion_id
            JOIN cantons ON cantons.id=csp_agenda_territorials.canton_id
            WHERE csp_agenda_territorials.id in ($consulta) and csp_periodo_agendas.semana='Semana 2'"); 
        
        $agendaTerritorialSem2=Collection::make($agendaTerritorialSem2);

        $agendaTerritorialSem3=DB::select("SELECT csp_agenda_territorials.id, csp_agenda_territorials.fecha_agenda,csp_agenda_territorials.tipo_comunicacional,csp_agenda_territorials.responsable,csp_agenda_territorials.descripcion_tipo_agenda,csp_agenda_territorials.descripcion_tipo_impacto,institucions.siglas_institucion as Institucion,csp_periodo_agendas.semana,csp_agenda_territorials.created_at as FechaRegistro,csp_tipo_agendas.nombre_tipo_agenda as TipoAgenda,csp_tipo_impacto_agendas.nombre_impacto as ImpactoAgenda, cantons.nombre_canton FROM csp_agenda_territorials
            JOIN csp_periodo_agendas ON csp_periodo_agendas.id=csp_agenda_territorials.periodo_agenda_id
            JOIN csp_tipo_agendas ON csp_tipo_agendas.id=csp_agenda_territorials.tipo_agenda_id
            JOIN csp_tipo_impacto_agendas ON csp_tipo_impacto_agendas.id=csp_agenda_territorials.tipo_impacto_id
            JOIN institucions ON institucions.id=csp_agenda_territorials.institucion_id
            JOIN cantons ON cantons.id=csp_agenda_territorials.canton_id
            WHERE csp_agenda_territorials.id in ($consulta) and csp_periodo_agendas.semana='Semana 3'");

        
        $agendaTerritorialSem3=Collection::make($agendaTerritorialSem3);

        $agendaTerritorialSem4=DB::select("SELECT csp_agenda_territorials.id, csp_agenda_territorials.fecha_agenda,csp_agenda_territorials.tipo_comunicacional,csp_agenda_territorials.responsable,csp_agenda_territorials.descripcion_tipo_agenda,csp_agenda_territorials.descripcion_tipo_impacto,institucions.siglas_institucion as Institucion,csp_periodo_agendas.semana,csp_agenda_territorials.created_at as FechaRegistro,csp_tipo_agendas.nombre_tipo_agenda as TipoAgenda,csp_tipo_impacto_agendas.nombre_impacto as ImpactoAgenda, cantons.nombre_canton FROM csp_agenda_territorials
            JOIN csp_periodo_agendas ON csp_periodo_agendas.id=csp_agenda_territorials.periodo_agenda_id
            JOIN csp_tipo_agendas ON csp_tipo_agendas.id=csp_agenda_territorials.tipo_agenda_id
            JOIN csp_tipo_impacto_agendas ON csp_tipo_impacto_agendas.id=csp_agenda_territorials.tipo_impacto_id
            JOIN institucions ON institucions.id=csp_agenda_territorials.institucion_id
            JOIN cantons ON cantons.id=csp_agenda_territorials.canton_id
            WHERE csp_agenda_territorials.id in ($consulta) and csp_periodo_agendas.semana='Semana 4'"); 
        
        $agendaTerritorialSem4=Collection::make($agendaTerritorialSem4);
        //dd($agendaTerritorialSem3);

        $agendaTerritorialSem5=DB::select("SELECT csp_agenda_territorials.id, csp_agenda_territorials.fecha_agenda,csp_agenda_territorials.tipo_comunicacional,csp_agenda_territorials.responsable,csp_agenda_territorials.descripcion_tipo_agenda,csp_agenda_territorials.descripcion_tipo_impacto,institucions.siglas_institucion as Institucion,csp_periodo_agendas.semana,csp_agenda_territorials.created_at as FechaRegistro,csp_tipo_agendas.nombre_tipo_agenda as TipoAgenda,csp_tipo_impacto_agendas.nombre_impacto as ImpactoAgenda, cantons.nombre_canton FROM csp_agenda_territorials
            JOIN csp_periodo_agendas ON csp_periodo_agendas.id=csp_agenda_territorials.periodo_agenda_id
            JOIN csp_tipo_agendas ON csp_tipo_agendas.id=csp_agenda_territorials.tipo_agenda_id
            JOIN csp_tipo_impacto_agendas ON csp_tipo_impacto_agendas.id=csp_agenda_territorials.tipo_impacto_id
            JOIN institucions ON institucions.id=csp_agenda_territorials.institucion_id
            JOIN cantons ON cantons.id=csp_agenda_territorials.canton_id
            WHERE csp_agenda_territorials.id in ($consulta) and csp_periodo_agendas.semana='Semana 5'"); 
        
        $agendaTerritorialSem5=Collection::make($agendaTerritorialSem5);
        return $this->crearPDF($agendaTerritorialSem1,$agendaTerritorialSem2,$agendaTerritorialSem3,$agendaTerritorialSem4,$agendaTerritorialSem5,$vistaurl,$tipo);
    }

    public function crearPDF($dato1,$dato2,$dato3,$dato4,$dato5,$vistaurl,$tipo)
    {
        
        $data1 = $dato1;
        $data2 = $dato2;
        $data3 = $dato3;
        $data4 = $dato4;
        $data5 = $dato5;
        $date = date('Y-m-d');
        $view = \View::make($vistaurl, compact('date'))->with(["data1"=>$data1,
                                                                "data2"=>$data2,
                                                                "data3"=>$data3,
                                                                "data4"=>$data4,
                                                                "data5"=>$data5]);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        if($tipo==1){return $pdf->stream($date.'_reporteAgendaterritorial.pdf');}
        if($tipo==2){return $pdf->download('reporte.pdf'); }
    }

    public function mostrarTabla(){
        return view('csp.cspAgendaTerritorial.reporte1');
    }

    
}
