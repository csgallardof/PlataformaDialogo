<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Solucion;
use App\NotificacionQuincenal;
use App\Institucion;
use App\User;
use App\ActorSolucion;
use App\Archivo;
use Mail;

use DB;
use File;
use Laracasts\Flash\Flash;
use Illuminate\Support\Collection as Collection;

class NotificacionQuincenalController extends Controller
{
    //
    public function enviarCorreo(Request $request)
    {

        $notificacionesq = DB::select('CALL pr_notificaciones_quincenales()');
        $notfUsed =  $notificacionesq[0];
        $title = 'Plataforma de Dialogo Nacional, Correo de Notificacion';
        $title_reporte = 'Report Quincenal de Propuestas Pendientes';
        $content = $notfUsed->problema_solucion;

        $usuarioArray = array();
        $email_origen=$notificacionesq[0]->email_usuario;
        $email_next="";
        $contador = 0;

        foreach ($notificacionesq as $notificacion_responsable){



            $email_next =$notificacion_responsable->email_usuario;


            if($email_origen==$email_next)
            {
                $usuarioArray[$contador] =array($notificacion_responsable->problema_solucion,$notificacion_responsable->estado_solucion,$notificacion_responsable->solucion_id, $notificacion_responsable->atendida_quince);
                $email_origen = $email_next;
                $contador++;
            }else{


                //$emails = [$email_origen];


                $date = date('Y-m-d');

                $view = \View::make("emails.correoNotificacion", compact('date'))->with(['title' => $title_reporte,  'notificacionesq'=> $usuarioArray]);
                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML($view);

               // $view = \View::make($vistaurl, compact('date'))->with(["data1"=>$data1]);
                //$pdf = \App::make('dompdf.wrapper');
                //$pdf->loadHTML($view);


                //$pdf = PDF::loadView('emails.correoNotificacion', ['title' => $title,  'notificacionesq'=> $usuarioArray]);
                //return $pdf->stream('reporteQuincenal.pdf');
                $email_origen_prueba=array('alex.dominguez@secom.gob.ec','alexpatde@gmail.com');
                $email_origen_f=$email_origen_prueba;
                Mail::send('emails.correoNotificacionHome', ['title' => $title,  'notificacionesq'=> $usuarioArray], function ($message) use ($email_origen_f,$pdf)
                {

                    $message->from('inteligencia.contacto@gmail.com', 'Secretaria de Gestión de la Política');

                    //$message->to('alexpatde@gmail.com')->subject('Reporte Quincenal de Propuestas Pendientes');
                    $message->to($email_origen_f)->subject('Reporte Quincenal de Propuestas Pendientes');
                    $message->attachData($pdf->output(), 'reporteQuincenal.pdf');

                });
                //return;
                $contador=0;
                unset($usuarioArray);
                $usuarioArray = array();
                $usuarioArray[$contador] =array($notificacion_responsable->problema_solucion,$notificacion_responsable->estado_solucion,$notificacion_responsable->solucion_id, $notificacion_responsable->atendida_quince);
                $email_origen = $email_next;


            }


        }


        //$pdf = PDF::loadView('emails.correoNotificacion', ['title' => $title,  'notificacionesq'=> $usuarioArray]);
        //return $pdf->stream('reporteQuincenal.pdf');
        $date = date('Y-m-d');

        $view = \View::make("emails.correoNotificacion", compact('date'))->with(['title' => $title,  'notificacionesq'=> $usuarioArray]);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        $email_origen_prueba=array('alex.dominguez@secom.gob.ec','alexpatde@gmail.com');
        $email_origen_f=$email_origen_prueba;
        Mail::send('emails.correoNotificacionHome', ['title' => $title,  'notificacionesq'=> $usuarioArray], function ($message) use ($email_origen_f,$pdf)
        {

            $message->from('inteligencia.contacto@gmail.com', 'Secretaria de Gestión de la Política');

            //$message->to('alexpatde@gmail.com')->subject('Reporte Quincenal de Propuestas Pendientes');
            $message->to($email_origen_f)->subject('Reporte Quincenal de Propuestas Pendientes');
            $message->attachData($pdf->output(), 'reporteQuincenal.pdf');

        });


        $notificacionPropuesta = DB::table('notificacion_quincenal')->where('estado', 0)->update(['estado' => 1]);
        return response()->json(['message' => 'Request completed']);
    }


    public function enviarCorreo2(Request $request)
    {

        /*$notificacionesq = DB::select('CALL pr_notificaciones_quincenales()');
        $notfUsed =  $notificacionesq[0];
        $title = 'Propuestas Pendientes';
        $content = $notfUsed->problema_solucion;*/
        return view('emails.correoNotificacion')->with(['title' => $title,  'notificacionesq'=> $notificacionesq]);
    }





    public function prueba()
    {
        return view('emails.correoEnviarNotificacion');
    }


}
