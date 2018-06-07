<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection as Collection;
use App\CspReportesHecho;
use App\CspPeriodoReporte;
use Laracasts\Flash\Flash;
use DB;
//use App\Pais;


class PdfCspReportesController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listaReportesCsp(){
        $CspPeriodoReporte = CspPeriodoReporte::all();
        $buscarTipoComunicacional="Todos";
        $buscar=0;
    	$reportesHechos = DB::table('csp_reportes_hechos')
        ->join('csp_periodo_reportes','csp_periodo_reportes.id', '=','csp_reportes_hechos.periodo_id')
        ->join('institucions','institucions.id', '=','csp_reportes_hechos.institucion_id')
        ->select('csp_reportes_hechos.id','csp_reportes_hechos.fecha_reporte','csp_reportes_hechos.tipo_comunicacional','csp_reportes_hechos.tema','csp_reportes_hechos.descripcion','csp_reportes_hechos.lugar','csp_reportes_hechos.fuente','institucions.siglas_institucion as Institucion','csp_reportes_hechos.anexo','csp_reportes_hechos.created_at as FechaRegistro','csp_periodo_reportes.nombre as Periodo')
        ->orderBy('csp_reportes_hechos.id','DESC')
        ->get();
        return view("csp.reportesPdfCsp.listaReportesCsp")->with(["reportesHechos"=>$reportesHechos,
                                                                "CspPeriodoReporte"=>$CspPeriodoReporte,
                                                                "buscar"=>$buscar,
                                                                "buscarTipoComunicacional"=>$buscarTipoComunicacional]);
    }
    public function buscarReportesHechos(Request $request){
         $buscar = $request-> parametro;

         $buscarTipoComunicacional = $request-> tipo_comunicacional;

         //dd($buscarTipoComunicacional); 
         //dd($buscar);
         $CspPeriodoReporte = CspPeriodoReporte::all();
        
        if($buscarTipoComunicacional!=null&& $buscar!=null&& $buscarTipoComunicacional!="Todos"){

            $reportesHechos = DB::table('csp_reportes_hechos')
            ->join('csp_periodo_reportes','csp_periodo_reportes.id', '=','csp_reportes_hechos.periodo_id')
            ->join('institucions','institucions.id', '=','csp_reportes_hechos.institucion_id')
            ->where('csp_reportes_hechos.periodo_id', '=',$buscar)
            ->where('csp_reportes_hechos.tipo_comunicacional', '=',$buscarTipoComunicacional)
            ->select('csp_reportes_hechos.id','csp_reportes_hechos.fecha_reporte','csp_reportes_hechos.tipo_comunicacional','csp_reportes_hechos.tema','csp_reportes_hechos.descripcion','csp_reportes_hechos.lugar','csp_reportes_hechos.fuente','institucions.siglas_institucion as Institucion','csp_reportes_hechos.anexo','csp_reportes_hechos.created_at as FechaRegistro','csp_periodo_reportes.nombre as Periodo')
            ->orderBy('csp_reportes_hechos.id','DESC')
            ->get();

        return view("csp.reportesPdfCsp.listaReportesCsp")->with(["reportesHechos"=>$reportesHechos,
                                                                "CspPeriodoReporte"=>$CspPeriodoReporte,
                                                                "buscar"=>$buscar,
                                                                "buscarTipoComunicacional"=>$buscarTipoComunicacional]);


        }elseif($buscar!=null){
            //dd('No estoy ');
            //dd('Segundo if');
            //dd($buscarTipoComunicacional);
         $buscarTipoComunicacional="Todos";
         //dd($buscarTipoComunicacional);
         $reportesHechos = DB::table('csp_reportes_hechos')
        ->join('csp_periodo_reportes','csp_periodo_reportes.id', '=','csp_reportes_hechos.periodo_id')
        ->join('institucions','institucions.id', '=','csp_reportes_hechos.institucion_id')
        ->where('csp_reportes_hechos.periodo_id', '=',$buscar)
        ->select('csp_reportes_hechos.id','csp_reportes_hechos.fecha_reporte','csp_reportes_hechos.tipo_comunicacional','csp_reportes_hechos.tema','csp_reportes_hechos.descripcion','csp_reportes_hechos.lugar','csp_reportes_hechos.fuente','institucions.siglas_institucion as Institucion','csp_reportes_hechos.anexo','csp_reportes_hechos.created_at as FechaRegistro','csp_periodo_reportes.nombre as Periodo')
        ->orderBy('csp_reportes_hechos.id','DESC')
        ->get();
         return view("csp.reportesPdfCsp.listaReportesCsp")->with(["reportesHechos"=>$reportesHechos,
                                                                    "CspPeriodoReporte"=>$CspPeriodoReporte,
                                                                    "buscar"=>$buscar,
                                                                    "buscarTipoComunicacional"=>$buscarTipoComunicacional]);

         }elseif($buscar==null&&$buscarTipoComunicacional!=null&&$buscarTipoComunicacional!="Todos"){
            //dd(' if 3');
            $buscar=0;
             $reportesHechos = DB::table('csp_reportes_hechos')
            ->join('csp_periodo_reportes','csp_periodo_reportes.id', '=','csp_reportes_hechos.periodo_id')
            ->join('institucions','institucions.id', '=','csp_reportes_hechos.institucion_id')
            ->where('csp_reportes_hechos.tipo_comunicacional', '=',$buscarTipoComunicacional)
            ->select('csp_reportes_hechos.id','csp_reportes_hechos.fecha_reporte','csp_reportes_hechos.tipo_comunicacional','csp_reportes_hechos.tema','csp_reportes_hechos.descripcion','csp_reportes_hechos.lugar','csp_reportes_hechos.fuente','institucions.siglas_institucion as Institucion','csp_reportes_hechos.anexo','csp_reportes_hechos.created_at as FechaRegistro','csp_periodo_reportes.nombre as Periodo')
            ->orderBy('csp_reportes_hechos.id','DESC')
            ->get();
             //dd('Aqui',$reportesHechos);   
        return view("csp.reportesPdfCsp.listaReportesCsp")->with(["reportesHechos"=>$reportesHechos,
                                                                "CspPeriodoReporte"=>$CspPeriodoReporte,
                                                                "buscar"=>$buscar,
                                                                "buscarTipoComunicacional"=>$buscarTipoComunicacional]);


         }else
        //$buscarTipoComunicacional="Todos";
            //dd($buscarTipoComunicacional);
         return redirect('/institucion/lista-reportes-csp'); 
    }
    public function crearPDF($dato1,$dato2,$dato3,$periodo_reporte,$tipo_reporte,$vistaurl,$tipo)
    {
        
        $PeriodoSemanaCspReporte = CspPeriodoReporte::find($periodo_reporte);

        $data1 = $dato1;
        $data2 = $dato2;
        $data3 = $dato3;
         
        //$elementos= sizeof($data1);
        //dd($elementos);
        $date = date('Y-m-d');
        $view = \View::make($vistaurl, compact('date'))->with(["data1"=>$data1,
                                                               "data2"=>$data2,
                                                               "data3"=>$data3,
                                                               "tipo_reporte"=>$tipo_reporte,                
                                                               "PeriodoSemanaCspReporte"=>$PeriodoSemanaCspReporte]);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        
        if($tipo==1){return $pdf->stream('reporteHechosRelevaltes.pdf');}
        if($tipo==2){return $pdf->download('reporte.pdf'); }
    }


    public function crearReporteHechosRelevantes(Request $request,$tipo){
        //dd(  );
     if(is_null($request['check'])){
        
            Flash::error("Debe Seleccionar uno o más  Reportes");
            return redirect('/institucion/lista-reportes-csp');

     }
     else //dd('validado');
        //dd($periodo_reporte);
     $vistaurl="csp.reportesPdfCsp.pdf";
     $tipo_reporte=$request['tipo_reporte'];
     $periodo_reporte=$request['periodo_reporte'];
     //dd($periodo_reporte);
     $cheches = $request['check'];
     $check="";
     if($tipo_reporte=="Todos"){
        for ($i=0; $i <count($cheches) ; $i++) { 
            $check .= $cheches[$i].",";
        }
        $consulta=substr($check,0,-1); 
        $reporteHechoMipro=DB::select("SELECT csp_reportes_hechos.id,csp_reportes_hechos.tipo_comunicacional,csp_reportes_hechos.fecha_reporte, csp_reportes_hechos.tema, csp_reportes_hechos.fuente, csp_reportes_hechos.descripcion, csp_reportes_hechos.lugar,csp_reportes_hechos.porcentaje_avance, institucions.siglas_institucion as Institucion FROM csp_reportes_hechos
            JOIN institucions ON institucions.id= csp_reportes_hechos.institucion_id 
            WHERE csp_reportes_hechos.id in ($consulta) and csp_reportes_hechos.institucion_id=3");
        
        $reporteHechoMipro=Collection::make($reporteHechoMipro);
        //dd($reporteHechoMipro);

        $reporteHechoMAP=DB::select("SELECT csp_reportes_hechos.id,csp_reportes_hechos.fecha_reporte,csp_reportes_hechos.tipo_comunicacional, csp_reportes_hechos.tema, csp_reportes_hechos.fuente, csp_reportes_hechos.descripcion, csp_reportes_hechos.lugar,csp_reportes_hechos.porcentaje_avance, institucions.siglas_institucion as Institucion FROM csp_reportes_hechos
            JOIN institucions ON institucions.id= csp_reportes_hechos.institucion_id 
            WHERE csp_reportes_hechos.id in ($consulta) and csp_reportes_hechos.institucion_id=2");
        
        $reporteHechoMAP=Collection::make($reporteHechoMAP);
        
        $reporteHechoMAG=DB::select("SELECT csp_reportes_hechos.id,csp_reportes_hechos.fecha_reporte,csp_reportes_hechos.tipo_comunicacional, csp_reportes_hechos.tema, csp_reportes_hechos.fuente, csp_reportes_hechos.descripcion, csp_reportes_hechos.lugar,csp_reportes_hechos.porcentaje_avance, institucions.siglas_institucion as Institucion FROM csp_reportes_hechos
            JOIN institucions ON institucions.id= csp_reportes_hechos.institucion_id 
            WHERE csp_reportes_hechos.id in ($consulta) and csp_reportes_hechos.institucion_id=1");
        
        $reporteHechoMAG=Collection::make($reporteHechoMAG);
        
        //dd($reporteHechoSTR);

        return $this->crearPDF($reporteHechoMipro,$reporteHechoMAP,$reporteHechoMAG,$periodo_reporte,$tipo_reporte, $vistaurl,$tipo);
     }else
     
     
     //dd($tipo_reporte);
     
     
    	for ($i=0; $i <count($cheches) ; $i++) { 
            $check .= $cheches[$i].",";
        }
        $consulta=substr($check,0,-1); 
        $reporteHechoMipro=DB::select("SELECT csp_reportes_hechos.id,csp_reportes_hechos.tipo_comunicacional,csp_reportes_hechos.fecha_reporte, csp_reportes_hechos.tema, csp_reportes_hechos.fuente, csp_reportes_hechos.descripcion, csp_reportes_hechos.lugar,csp_reportes_hechos.porcentaje_avance, institucions.siglas_institucion as Institucion FROM csp_reportes_hechos
            JOIN institucions ON institucions.id= csp_reportes_hechos.institucion_id 
            WHERE csp_reportes_hechos.id in ($consulta) and csp_reportes_hechos.institucion_id=3 and csp_reportes_hechos.tipo_comunicacional='$tipo_reporte' ");
        
        $reporteHechoMipro=Collection::make($reporteHechoMipro);
        //dd($reporteHechoMipro);

        $reporteHechoMAP=DB::select("SELECT csp_reportes_hechos.id,csp_reportes_hechos.fecha_reporte,csp_reportes_hechos.tipo_comunicacional, csp_reportes_hechos.tema, csp_reportes_hechos.fuente, csp_reportes_hechos.descripcion, csp_reportes_hechos.lugar,csp_reportes_hechos.porcentaje_avance, institucions.siglas_institucion as Institucion FROM csp_reportes_hechos
            JOIN institucions ON institucions.id= csp_reportes_hechos.institucion_id 
            WHERE csp_reportes_hechos.id in ($consulta) and csp_reportes_hechos.institucion_id=2 and csp_reportes_hechos.tipo_comunicacional='$tipo_reporte'");
        
        $reporteHechoMAP=Collection::make($reporteHechoMAP);
        
        $reporteHechoMAG=DB::select("SELECT csp_reportes_hechos.id,csp_reportes_hechos.fecha_reporte,csp_reportes_hechos.tipo_comunicacional, csp_reportes_hechos.tema, csp_reportes_hechos.fuente, csp_reportes_hechos.descripcion, csp_reportes_hechos.lugar,csp_reportes_hechos.porcentaje_avance, institucions.siglas_institucion as Institucion FROM csp_reportes_hechos
            JOIN institucions ON institucions.id= csp_reportes_hechos.institucion_id 
            WHERE csp_reportes_hechos.id in ($consulta) and csp_reportes_hechos.institucion_id=1 and csp_reportes_hechos.tipo_comunicacional='$tipo_reporte'");
        
        $reporteHechoMAG=Collection::make($reporteHechoMAG);
        
        //dd($reporteHechoSTR);

        return $this->crearPDF($reporteHechoMipro,$reporteHechoMAP,$reporteHechoMAG,$periodo_reporte,$tipo_reporte, $vistaurl,$tipo);
    }

    public function listaLineasDiscursivasCsp(){
        $buscarTipoComunicacional="Todos";
        $buscar=0;
        $CspPeriodoReporte = CspPeriodoReporte::all();
        $reportesHechos = DB::table('csp_reportes_hechos')
        ->join('csp_periodo_reportes','csp_periodo_reportes.id', '=','csp_reportes_hechos.periodo_id')
        ->join('institucions','institucions.id', '=','csp_reportes_hechos.institucion_id')
        ->select('csp_reportes_hechos.id','csp_reportes_hechos.fecha_reporte','csp_reportes_hechos.tema','csp_reportes_hechos.tipo_comunicacional','csp_reportes_hechos.descripcion','csp_reportes_hechos.lugar','csp_reportes_hechos.fuente','csp_reportes_hechos.lineas_discursivas','institucions.siglas_institucion as Institucion','csp_reportes_hechos.anexo','csp_reportes_hechos.created_at as FechaRegistro','csp_periodo_reportes.nombre as Periodo')
        ->orderBy('csp_reportes_hechos.id','DESC')
        ->get();
        return view("csp.reportesPdfCsp.listaReportesLineasDiscursivasCsp")->with(["reportesHechos"=>$reportesHechos,
                                                                                    "CspPeriodoReporte"=>$CspPeriodoReporte,
                                                                                    "buscarTipoComunicacional"=>$buscarTipoComunicacional,
                                                                                    "buscar"=>$buscar
                                                                                    ]);
    }
    public function buscarReportesHechosLineasDiscursivas(Request $request){
         $buscar = $request-> parametro;

         $buscarTipoComunicacional = $request-> tipo_comunicacional;
         //dd($buscarTipoComunicacional); 
         //dd($buscar);
         $CspPeriodoReporte = CspPeriodoReporte::all();
        
        if($buscarTipoComunicacional!=null&& $buscar!=null&& $buscarTipoComunicacional!="Todos"){
            
            $reportesHechos = DB::table('csp_reportes_hechos')
            ->join('csp_periodo_reportes','csp_periodo_reportes.id', '=','csp_reportes_hechos.periodo_id')
            ->join('institucions','institucions.id', '=','csp_reportes_hechos.institucion_id')
            ->where('csp_reportes_hechos.periodo_id', '=',$buscar)
            ->where('csp_reportes_hechos.tipo_comunicacional', '=',$buscarTipoComunicacional)
            ->select('csp_reportes_hechos.id','csp_reportes_hechos.fecha_reporte','csp_reportes_hechos.tipo_comunicacional','csp_reportes_hechos.tema','csp_reportes_hechos.descripcion','csp_reportes_hechos.lugar','csp_reportes_hechos.fuente','institucions.siglas_institucion as Institucion','csp_reportes_hechos.anexo','csp_reportes_hechos.created_at as FechaRegistro','csp_periodo_reportes.nombre as Periodo')
            ->orderBy('csp_reportes_hechos.id','DESC')
            ->get();

       return view("csp.reportesPdfCsp.listaReportesLineasDiscursivasCsp")->with(["reportesHechos"=>$reportesHechos,
                                                                                "CspPeriodoReporte"=>$CspPeriodoReporte,
                                                                                "buscar"=>$buscar,
                                                                                "buscarTipoComunicacional"=>$buscarTipoComunicacional
                                                                                ]);


        }elseif($buscar!=null){
        $buscarTipoComunicacional="Todos";
         $reportesHechos = DB::table('csp_reportes_hechos')
        ->join('csp_periodo_reportes','csp_periodo_reportes.id', '=','csp_reportes_hechos.periodo_id')
        ->join('institucions','institucions.id', '=','csp_reportes_hechos.institucion_id')
        ->where('csp_reportes_hechos.periodo_id', '=',$buscar)
        ->select('csp_reportes_hechos.id','csp_reportes_hechos.fecha_reporte','csp_reportes_hechos.tipo_comunicacional','csp_reportes_hechos.tema','csp_reportes_hechos.descripcion','csp_reportes_hechos.lugar','csp_reportes_hechos.fuente','institucions.siglas_institucion as Institucion','csp_reportes_hechos.anexo','csp_reportes_hechos.created_at as FechaRegistro','csp_periodo_reportes.nombre as Periodo')
        ->orderBy('csp_reportes_hechos.id','DESC')
        ->get();
        return view("csp.reportesPdfCsp.listaReportesLineasDiscursivasCsp")->with(["reportesHechos"=>$reportesHechos,
                                                                                    "CspPeriodoReporte"=>$CspPeriodoReporte,
                                                                                    "buscar"=>$buscar,
                                                                                    "buscarTipoComunicacional"=>$buscarTipoComunicacional
                                                                                ]);
         }elseif($buscar==null&&$buscarTipoComunicacional!=null&&$buscarTipoComunicacional!="Todos"){
             $buscar=0;
             $reportesHechos = DB::table('csp_reportes_hechos')
            ->join('csp_periodo_reportes','csp_periodo_reportes.id', '=','csp_reportes_hechos.periodo_id')
            ->join('institucions','institucions.id', '=','csp_reportes_hechos.institucion_id')
            ->where('csp_reportes_hechos.tipo_comunicacional', '=',$buscarTipoComunicacional)
            ->select('csp_reportes_hechos.id','csp_reportes_hechos.fecha_reporte','csp_reportes_hechos.tipo_comunicacional','csp_reportes_hechos.tema','csp_reportes_hechos.descripcion','csp_reportes_hechos.lugar','csp_reportes_hechos.fuente','institucions.siglas_institucion as Institucion','csp_reportes_hechos.anexo','csp_reportes_hechos.created_at as FechaRegistro','csp_periodo_reportes.nombre as Periodo')
            ->orderBy('csp_reportes_hechos.id','DESC')
            ->get();
             //dd('Aqui',$reportesHechos);   
       return view("csp.reportesPdfCsp.listaReportesLineasDiscursivasCsp")->with(["reportesHechos"=>$reportesHechos,
                                                                                "CspPeriodoReporte"=>$CspPeriodoReporte,
                                                                                "buscar"=>$buscar,
                                                                                "buscarTipoComunicacional"=>$buscarTipoComunicacional
                                                                                ]);


         }else
         return redirect('/institucion/reportes-lineas-discursivas-csp');
        
    }

    public function crearReporteHechosLineasDiscursivas(Request $request,$tipo){

     if(is_null($request['check'])){
        Flash::error("Recuerde seleccionar uno o mas Reportes");
        return redirect('/institucion/reportes-lineas-discursivas-csp');

     }else
        //dd($periodo_reporte);
     $vistaurl="csp.reportesPdfCsp.pdfLineasDiscursivas";
     $tipo_reporte=$request['tipo_reporte'];
      $periodo_reporte=$request['periodo_reporte'];
     //dd($tipo_reporte);
     $cheches = $request['check'];
     $check="";
     if($tipo_reporte=="Todos"){
         for ($i=0; $i <count($cheches) ; $i++) { 
            $check .= $cheches[$i].",";
        }
        $consulta=substr($check,0,-1); 
        $reporteHechoMipro=DB::select("SELECT csp_reportes_hechos.fecha_reporte,csp_reportes_hechos.tipo_comunicacional, csp_reportes_hechos.tema, csp_reportes_hechos.fuente, csp_reportes_hechos.lineas_discursivas, institucions.siglas_institucion as Institucion FROM csp_reportes_hechos
            JOIN institucions ON institucions.id= csp_reportes_hechos.institucion_id 
            WHERE csp_reportes_hechos.id in ($consulta) and csp_reportes_hechos.institucion_id=3");
        
        $reporteHechoMipro=Collection::make($reporteHechoMipro);

        $reporteHechoMAP=DB::select("SELECT csp_reportes_hechos.fecha_reporte,csp_reportes_hechos.tipo_comunicacional, csp_reportes_hechos.tema, csp_reportes_hechos.fuente, csp_reportes_hechos.lineas_discursivas, institucions.siglas_institucion as Institucion FROM csp_reportes_hechos
            JOIN institucions ON institucions.id= csp_reportes_hechos.institucion_id 
            WHERE csp_reportes_hechos.id in ($consulta) and csp_reportes_hechos.institucion_id=2");
        
        $reporteHechoMAP=Collection::make($reporteHechoMAP);
        
        $reporteHechoMAG=DB::select("SELECT csp_reportes_hechos.fecha_reporte,csp_reportes_hechos.tipo_comunicacional, csp_reportes_hechos.tema, csp_reportes_hechos.fuente, csp_reportes_hechos.lineas_discursivas, institucions.siglas_institucion as Institucion FROM csp_reportes_hechos
            JOIN institucions ON institucions.id= csp_reportes_hechos.institucion_id 
            WHERE csp_reportes_hechos.id in ($consulta) and csp_reportes_hechos.institucion_id=1");
        
        $reporteHechoMAG=Collection::make($reporteHechoMAG);
       
       

        return $this->crearLineaDiscursivasPDF($reporteHechoMipro,$reporteHechoMAP,$reporteHechoMAG,$periodo_reporte,$tipo_reporte, $vistaurl,$tipo);
     }else
     
        for ($i=0; $i <count($cheches) ; $i++) { 
            $check .= $cheches[$i].",";
        }
        $consulta=substr($check,0,-1); 
        $reporteHechoMipro=DB::select("SELECT csp_reportes_hechos.fecha_reporte,csp_reportes_hechos.tipo_comunicacional, csp_reportes_hechos.tema, csp_reportes_hechos.fuente, csp_reportes_hechos.lineas_discursivas, institucions.siglas_institucion as Institucion FROM csp_reportes_hechos
            JOIN institucions ON institucions.id= csp_reportes_hechos.institucion_id 
            WHERE csp_reportes_hechos.id in ($consulta) and csp_reportes_hechos.institucion_id=3 and csp_reportes_hechos.tipo_comunicacional='$tipo_reporte'");
        
        $reporteHechoMipro=Collection::make($reporteHechoMipro);

        $reporteHechoMAP=DB::select("SELECT csp_reportes_hechos.fecha_reporte,csp_reportes_hechos.tipo_comunicacional, csp_reportes_hechos.tema, csp_reportes_hechos.fuente, csp_reportes_hechos.lineas_discursivas, institucions.siglas_institucion as Institucion FROM csp_reportes_hechos
            JOIN institucions ON institucions.id= csp_reportes_hechos.institucion_id 
            WHERE csp_reportes_hechos.id in ($consulta) and csp_reportes_hechos.institucion_id=2 and csp_reportes_hechos.tipo_comunicacional='$tipo_reporte'");
        
        $reporteHechoMAP=Collection::make($reporteHechoMAP);
        
        $reporteHechoMAG=DB::select("SELECT csp_reportes_hechos.fecha_reporte,csp_reportes_hechos.tipo_comunicacional, csp_reportes_hechos.tema, csp_reportes_hechos.fuente, csp_reportes_hechos.lineas_discursivas, institucions.siglas_institucion as Institucion FROM csp_reportes_hechos
            JOIN institucions ON institucions.id= csp_reportes_hechos.institucion_id 
            WHERE csp_reportes_hechos.id in ($consulta) and csp_reportes_hechos.institucion_id=1 and csp_reportes_hechos.tipo_comunicacional='$tipo_reporte'");
        
        $reporteHechoMAG=Collection::make($reporteHechoMAG);
       
       

        return $this->crearLineaDiscursivasPDF($reporteHechoMipro,$reporteHechoMAP,$reporteHechoMAG,$periodo_reporte,$tipo_reporte, $vistaurl,$tipo);
    }
    public function crearLineaDiscursivasPDF($dato1,$dato2,$dato3,$periodo_reporte,$tipo_reporte,$vistaurl,$tipo)
    {
        
        $PeriodoSemanaCspReporte = CspPeriodoReporte::find($periodo_reporte);
        $data1 = $dato1;
        $data2 = $dato2;
        $data3 = $dato3;
        
        //$elementos= sizeof($data1);
        //dd($data1);
        $date = date('Y-m-d');
        $view = \View::make($vistaurl, compact('date'))->with(["data1"=>$data1,
                                                               "data2"=>$data2,
                                                               "data3"=>$data3,
                                                               "tipo_reporte"=>$tipo_reporte,
                                                                               
                                                               "PeriodoSemanaCspReporte"=>$PeriodoSemanaCspReporte]);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        
        if($tipo==1){return $pdf->stream('reporteHechosLineasDiscursivas.pdf');}
        if($tipo==2){return $pdf->download('reporteHechosLineasDiscursivas.pdf'); }
    }
   




    public function listaReportesAlertasCsp(){
        $CspPeriodoReporte = CspPeriodoReporte::all();
        $buscarTipoComunicacional="Todos";
        $buscar=0;
        $reportesAlerta = DB::table('csp_reportes_alertas')
        ->join('csp_periodo_reportes','csp_periodo_reportes.id', '=','csp_reportes_alertas.periodo_id')
        ->join('csp_reporte_estados','csp_reporte_estados.id', '=','csp_reportes_alertas.estado_reporte_id')
        ->join('institucions','institucions.id', '=','csp_reportes_alertas.institucion_id')
        ->select('csp_reportes_alertas.id','csp_reportes_alertas.fecha_atencion','csp_reportes_alertas.tipo_comunicacional','csp_reportes_alertas.tema','csp_reportes_alertas.descripcion','csp_reportes_alertas.fuente','csp_reportes_alertas.riesgo_principal','csp_reporte_estados.nombre as EstadoReporte','csp_reportes_alertas.anexo','institucions.siglas_institucion as Institucion','csp_reportes_alertas.created_at as FechaRegistro','csp_periodo_reportes.nombre as Periodo')
        ->orderBy('csp_reportes_alertas.id','DESC')
        ->get();
        return view("csp.reportesPdfCsp.listaReportesAlertasCsp")->with(["reportesAlerta"=>$reportesAlerta,
                                                                        "CspPeriodoReporte"=>$CspPeriodoReporte,
                                                                        "buscarTipoComunicacional"=>$buscarTipoComunicacional,
                                                                        "buscar"=>$buscar
                                                                        ]);
    }

    public function buscarReportesAlertas(Request $request){
        $CspPeriodoReporte = CspPeriodoReporte::all();
        $buscar = $request-> parametro;
        $buscarTipoComunicacional = $request-> tipo_comunicacional;

        if($buscarTipoComunicacional!=null&& $buscar!=null && $buscarTipoComunicacional!="Todos"){

             $reportesAlerta = DB::table('csp_reportes_alertas')
        ->join('csp_periodo_reportes','csp_periodo_reportes.id', '=','csp_reportes_alertas.periodo_id')
        ->join('csp_reporte_estados','csp_reporte_estados.id', '=','csp_reportes_alertas.estado_reporte_id')
        ->join('institucions','institucions.id', '=','csp_reportes_alertas.institucion_id')
        ->where('csp_reportes_alertas.periodo_id', '=',$buscar)
        ->where('csp_reportes_alertas.tipo_comunicacional', '=',$buscarTipoComunicacional)
        ->select('csp_reportes_alertas.id','csp_reportes_alertas.fecha_atencion','csp_reportes_alertas.tipo_comunicacional','csp_reportes_alertas.tema','csp_reportes_alertas.descripcion','csp_reportes_alertas.fuente','csp_reportes_alertas.riesgo_principal','csp_reporte_estados.nombre as EstadoReporte','csp_reportes_alertas.anexo','institucions.siglas_institucion as Institucion','csp_reportes_alertas.created_at as FechaRegistro','csp_periodo_reportes.nombre as Periodo')
        ->orderBy('csp_reportes_alertas.id','DESC')
        ->get();
        return view("csp.reportesPdfCsp.listaReportesAlertasCsp")->with(["reportesAlerta"=>$reportesAlerta,
                                                                        "CspPeriodoReporte"=>$CspPeriodoReporte,
                                                                        "buscar"=>$buscar,
                                                                        "buscarTipoComunicacional"=>$buscarTipoComunicacional
                                                                    ]);

        }elseif($buscar!=null){
            $buscarTipoComunicacional="Todos";
        $reportesAlerta = DB::table('csp_reportes_alertas')
        ->join('csp_periodo_reportes','csp_periodo_reportes.id', '=','csp_reportes_alertas.periodo_id')
        ->join('csp_reporte_estados','csp_reporte_estados.id', '=','csp_reportes_alertas.estado_reporte_id')
        ->join('institucions','institucions.id', '=','csp_reportes_alertas.institucion_id')
        ->where('csp_reportes_alertas.periodo_id', '=',$buscar)
        ->select('csp_reportes_alertas.id','csp_reportes_alertas.fecha_atencion','csp_reportes_alertas.tema','csp_reportes_alertas.tipo_comunicacional','csp_reportes_alertas.descripcion','csp_reportes_alertas.fuente','csp_reportes_alertas.riesgo_principal','csp_reporte_estados.nombre as EstadoReporte','csp_reportes_alertas.anexo','institucions.siglas_institucion as Institucion','csp_reportes_alertas.created_at as FechaRegistro','csp_periodo_reportes.nombre as Periodo')
        ->orderBy('csp_reportes_alertas.id','DESC')
        ->get();
        return view("csp.reportesPdfCsp.listaReportesAlertasCsp")->with(["reportesAlerta"=>$reportesAlerta,
                                                                        "CspPeriodoReporte"=>$CspPeriodoReporte,
                                                                         "buscar"=>$buscar,
                                                                    "buscarTipoComunicacional"=>$buscarTipoComunicacional
                                                                    ]);

        }elseif($buscar==null&&$buscarTipoComunicacional!=null&&$buscarTipoComunicacional!="Todos"){

            $buscar=0;

             $reportesAlerta = DB::table('csp_reportes_alertas')
        ->join('csp_periodo_reportes','csp_periodo_reportes.id', '=','csp_reportes_alertas.periodo_id')
        ->join('csp_reporte_estados','csp_reporte_estados.id', '=','csp_reportes_alertas.estado_reporte_id')
        ->join('institucions','institucions.id', '=','csp_reportes_alertas.institucion_id')
        ->where('csp_reportes_alertas.tipo_comunicacional', '=',$buscarTipoComunicacional)
        ->select('csp_reportes_alertas.id','csp_reportes_alertas.fecha_atencion','csp_reportes_alertas.tipo_comunicacional','csp_reportes_alertas.tema','csp_reportes_alertas.descripcion','csp_reportes_alertas.fuente','csp_reportes_alertas.riesgo_principal','csp_reporte_estados.nombre as EstadoReporte','csp_reportes_alertas.anexo','institucions.siglas_institucion as Institucion','csp_reportes_alertas.created_at as FechaRegistro','csp_periodo_reportes.nombre as Periodo')
        ->orderBy('csp_reportes_alertas.id','DESC')
        ->get();
        return view("csp.reportesPdfCsp.listaReportesAlertasCsp")->with(["reportesAlerta"=>$reportesAlerta,
                                                                        "CspPeriodoReporte"=>$CspPeriodoReporte,
                                                                         "buscar"=>$buscar,
                                                                "buscarTipoComunicacional"=>$buscarTipoComunicacional
                                                                    ]);
        }else 
        return redirect('/institucion/reportes-alertas-csp'); 

        

    }
     public function crearReporteAlerta(Request $request,$tipo){
       
        if(is_null($request['check'])){
        Flash::error("Recuerde seleccionar uno o mas Reportes");
        return redirect('/institucion/reportes-alertas-csp');

     }else
        //dd($periodo_reporte);
     $vistaurl="csp.reportesPdfCsp.pdfReporteAlertas";
      $tipo_reporte=$request['tipo_reporte'];
      $periodo_reporte=$request['periodo_reporte'];
     
     $cheches = $request['check'];
     $check="";
     if($tipo_reporte=="Todos"){
        for ($i=0; $i <count($cheches) ; $i++) { 
            $check .= $cheches[$i].",";
            //$acciones = DB::select

        }
        $consulta=substr($check,0,-1);

        DB::statement('SET GLOBAL group_concat_max_len = 9000000'); 

        $reporteAlertaMipro= DB::select("SELECT csp_reportes_alertas.id,csp_reportes_alertas.solucion_propuesta,csp_reportes_alertas.fecha_atencion,csp_reportes_alertas.tipo_comunicacional, csp_reportes_alertas.tema, csp_reportes_alertas.fuente,csp_reportes_alertas.descripcion, csp_reportes_alertas.riesgo_principal, institucions.siglas_institucion as Institucion,group_concat(csp_acciones_alertas.acciones SEPARATOR '<br>') as acciones FROM csp_reportes_alertas JOIN institucions ON institucions.id= csp_reportes_alertas.institucion_id LEFT JOIN csp_acciones_alertas on csp_acciones_alertas.reporte_alerta_id = csp_reportes_alertas.id WHERE csp_reportes_alertas.id in ($consulta) and csp_reportes_alertas.institucion_id=3 group by csp_reportes_alertas.id");
        $reporteAlertaMipro=Collection::make($reporteAlertaMipro);

        $reporteAlertaMAP= DB::select("SELECT csp_reportes_alertas.id,csp_reportes_alertas.solucion_propuesta,csp_reportes_alertas.fecha_atencion,csp_reportes_alertas.tipo_comunicacional, csp_reportes_alertas.tema, csp_reportes_alertas.fuente,csp_reportes_alertas.descripcion, csp_reportes_alertas.riesgo_principal, institucions.siglas_institucion as Institucion,group_concat(csp_acciones_alertas.acciones SEPARATOR '<br>') as acciones FROM csp_reportes_alertas JOIN institucions ON institucions.id= csp_reportes_alertas.institucion_id LEFT JOIN csp_acciones_alertas on csp_acciones_alertas.reporte_alerta_id = csp_reportes_alertas.id WHERE csp_reportes_alertas.id in ($consulta) and csp_reportes_alertas.institucion_id=2 group by csp_reportes_alertas.id");
        $reporteAlertaMAP=Collection::make($reporteAlertaMAP);

           
                   
        $reporteAlertaMAG= DB::select( "SELECT  csp_reportes_alertas.id,csp_reportes_alertas.solucion_propuesta,csp_reportes_alertas.fecha_atencion,csp_reportes_alertas.tipo_comunicacional, csp_reportes_alertas.tema, csp_reportes_alertas.fuente,csp_reportes_alertas.descripcion, csp_reportes_alertas.riesgo_principal, institucions.siglas_institucion as Institucion,group_concat(csp_acciones_alertas.acciones SEPARATOR '<br>') as acciones FROM csp_reportes_alertas JOIN institucions ON institucions.id= csp_reportes_alertas.institucion_id LEFT JOIN csp_acciones_alertas on csp_acciones_alertas.reporte_alerta_id = csp_reportes_alertas.id WHERE csp_reportes_alertas.id in ($consulta) and csp_reportes_alertas.institucion_id=1 group by csp_reportes_alertas.id");
        $reporteAlertaMAG=Collection::make($reporteAlertaMAG);
            //dd($reporteAlertaMAG);
        
        //dd($reporteAlertaMipro);
        return $this->crearAlertasPDF($reporteAlertaMipro,$reporteAlertaMAP,$reporteAlertaMAG,$periodo_reporte,$tipo_reporte,$vistaurl,$tipo);
     }else
        for ($i=0; $i <count($cheches) ; $i++) { 
            $check .= $cheches[$i].",";
            //$acciones = DB::select

        }
        $consulta=substr($check,0,-1);

        DB::statement('SET GLOBAL group_concat_max_len = 9000000'); 

        $reporteAlertaMipro= DB::select("SELECT csp_reportes_alertas.id,csp_reportes_alertas.solucion_propuesta,csp_reportes_alertas.fecha_atencion,csp_reportes_alertas.tipo_comunicacional, csp_reportes_alertas.tema, csp_reportes_alertas.fuente,csp_reportes_alertas.descripcion, csp_reportes_alertas.riesgo_principal, institucions.siglas_institucion as Institucion,group_concat(csp_acciones_alertas.acciones SEPARATOR '<br>') as acciones FROM csp_reportes_alertas JOIN institucions ON institucions.id= csp_reportes_alertas.institucion_id LEFT JOIN csp_acciones_alertas on csp_acciones_alertas.reporte_alerta_id = csp_reportes_alertas.id WHERE csp_reportes_alertas.id in ($consulta) and csp_reportes_alertas.institucion_id=3 and csp_reportes_alertas.tipo_comunicacional='$tipo_reporte' group by csp_reportes_alertas.id");
        $reporteAlertaMipro=Collection::make($reporteAlertaMipro);

        $reporteAlertaMAP= DB::select("SELECT csp_reportes_alertas.id,csp_reportes_alertas.solucion_propuesta,csp_reportes_alertas.fecha_atencion,csp_reportes_alertas.tipo_comunicacional, csp_reportes_alertas.tema, csp_reportes_alertas.fuente,csp_reportes_alertas.descripcion, csp_reportes_alertas.riesgo_principal, institucions.siglas_institucion as Institucion,group_concat(csp_acciones_alertas.acciones SEPARATOR '<br>') as acciones FROM csp_reportes_alertas JOIN institucions ON institucions.id= csp_reportes_alertas.institucion_id LEFT JOIN csp_acciones_alertas on csp_acciones_alertas.reporte_alerta_id = csp_reportes_alertas.id WHERE csp_reportes_alertas.id in ($consulta) and csp_reportes_alertas.institucion_id=2 and csp_reportes_alertas.tipo_comunicacional='$tipo_reporte' group by csp_reportes_alertas.id");
        $reporteAlertaMAP=Collection::make($reporteAlertaMAP);

        $reporteAlertaMAG= DB::select("SELECT csp_reportes_alertas.id,csp_reportes_alertas.solucion_propuesta,csp_reportes_alertas.fecha_atencion,csp_reportes_alertas.tipo_comunicacional, csp_reportes_alertas.tema, csp_reportes_alertas.fuente,csp_reportes_alertas.descripcion, csp_reportes_alertas.riesgo_principal, institucions.siglas_institucion as Institucion,group_concat(csp_acciones_alertas.acciones SEPARATOR '<br>') as acciones FROM csp_reportes_alertas JOIN institucions ON institucions.id= csp_reportes_alertas.institucion_id LEFT JOIN csp_acciones_alertas on csp_acciones_alertas.reporte_alerta_id = csp_reportes_alertas.id WHERE csp_reportes_alertas.id in ($consulta) and csp_reportes_alertas.institucion_id=1  and csp_reportes_alertas.tipo_comunicacional='$tipo_reporte' group by csp_reportes_alertas.id");
        $reporteAlertaMAG=Collection::make($reporteAlertaMAG);

        
        //dd($reporteAlertaMipro);
        return $this->crearAlertasPDF($reporteAlertaMipro,$reporteAlertaMAP,$reporteAlertaMAG,$periodo_reporte,$tipo_reporte,$vistaurl,$tipo);
    }
    public function crearAlertasPDF($dato1,$dato2,$dato3,$periodo_reporte,$tipo_reporte,$vistaurl,$tipo)
    {
        
        $PeriodoSemanaCspReporte = CspPeriodoReporte::find($periodo_reporte);
        $data1 = $dato1;
        $data2 = $dato2;
        $data3 = $dato3;
        
        
        //dd($data1);
        
        //$elementos= sizeof($data1);
        //dd($data1);
        $date = date('Y-m-d');
        $view = \View::make($vistaurl, compact('date'))->with(["data1"=>$data1,
                                                                "data2"=>$data2,
                                                                "data3"=>$data3,
                                                                "tipo_reporte"=>$tipo_reporte,                
                                                               "PeriodoSemanaCspReporte"=>$PeriodoSemanaCspReporte]);
        
        $pdf = \App::make('dompdf.wrapper');

        $pdf->loadHTML($view);
        //dd($data1);
        
        if($tipo==1){return $pdf->stream('reporteAlertas.pdf');}
        if($tipo==2){return $pdf->download('reporteAlertas.pdf'); }
    }
      

}
