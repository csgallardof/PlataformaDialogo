<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\NotificacionCiudadano;
use App\EmailCiudadanoComentario;
use App\EvaluacionCiudadano;
use App\Solucion;
use App\NotificacionQuincenal;
use App\Institucion;
use App\User;
use App\ActorSolucion;
use App\Archivo;
use App\Actividad;
use App\Ambit;
use App\EstadoSolucion;
use App\TipoDialogo;
use Mail;

use DB;
use File;
use Laracasts\Flash\Flash;
use Illuminate\Support\Collection as Collection;


class NotificacionCiudadanoController extends Controller
{
    //

    //


    public  function  saveCiudadanoEmail(Request $request,$solucion_id){

        //$notificacionC = NotificacionCiudadano
        $ciudadanoEmail = new NotificacionCiudadano();
        $ciudadanoEmail->not_cd_email  = $request-> emailciudadano;
        $ciudadanoEmail->not_cd_solucion_id = $solucion_id;
        $ciudadanoEmail->not_cd_fecha = date("Y-m-d");
        $mensaje_cd='';
        $Solucion = Solucion::find($solucion_id);
        $validacorreo = DB::table('notificacion_ciudadano')->where('not_cd_email', $request-> emailciudadano)
                                                           ->where('not_cd_solucion_id', $solucion_id)->first();
        if($validacorreo)
        {
            $mensaje_cd='Su email ya se encuentra registrado';
            Flash::success($mensaje_cd);
            //return view('detalle-despliegue2')->with(["solucion"=>$Solucion,"solucion_id"=>$solucion_id,"mensaje_cd"=>$mensaje_cd]);
            return $this->detalleSolucion($solucion_id,$mensaje_cd);
        }



        $ciudadanoEmail->save();


        //return redirect('/detalle-despliegue-dialogo/'.$solucion_id);
        Flash::success("Se ha registrado su email exitosamente");
        //return view('detalle-despliegue2')->with(["solucion"=>$Solucion,"solucion_id"=>$solucion_id,"mensaje_cd"=>$mensaje_cd]);
        return $this->detalleSolucion($solucion_id,$mensaje_cd);

    }

    public function saveCiudadanoEval(Request $request,$solucion_id){
        $ciudadanoEval = new EvaluacionCiudadano();
        $ciudadanoEval->ev_semaforo  = $request-> rd_evaluac;
        $ciudadanoEval->ev_solicitud_id  = $solucion_id;

        $ciudadanoEval->save();
        Flash::success("Se ha registrado su evaluación exitosamente");

        session_start();
        $_SESSION["ciudadano_evalua"] = true;

        //return view('detalle-despliegue2')->with(["solucion"=>$Solucion,"solucion_id"=>$solucion_id,"mensaje_cd"=>$mensaje_cd]);
        //return redirect('/detalle-despliegue-dialogo/'.$solucion_id);
        //return redirect()->route('/detalle-despliegue-dialogo/',[$solucion_id]);
        return redirect('/detalle-despliegue-dialogo/'.$solucion_id);
    }

    public function enviarCorreoEvCd(Request $request,$solucion_id){
        $title='Percepción de ciudadanos frente a propuesta de mesa de dialogo';

        $mensaje_cd= $request->comentario_propuesta_c;
        $mail_from= $request->email_cd_alerta;

        //validacion de correo
        $validacorreo = DB::table('email_ciudadano_comentario')->where('email_cc', $mail_from)->where('solicitud_id', $solucion_id)->first();
        if($validacorreo)
        {
            $mensaje_cd='Su email ya se encuentra registrado';
            Flash::error($mensaje_cd);
            //return view('detalle-despliegue2')->with(["solucion"=>$Solucion,"solucion_id"=>$solucion_id,"mensaje_cd"=>$mensaje_cd]);
            //return $this->detalleSolucion($solucion_id,$mensaje_cd);
            return redirect('/detalle-despliegue-dialogo/'.$solucion_id);
        }

        //
        $email_destino='';

        $ciudadanoEval = new EvaluacionCiudadano();
        $ciudadanoEval->ev_semaforo  = 'MALA';
        $ciudadanoEval->ev_solicitud_id  = $solucion_id;
        $ciudadanoEval->save();

        $email_ciudadano_comentario = new EmailCiudadanoComentario();
        $email_ciudadano_comentario->email_cc      = $mail_from;
        $email_ciudadano_comentario->comentario_cc = $mensaje_cd;
        $email_ciudadano_comentario->solicitud_id =$solucion_id;
        $email_ciudadano_comentario->estado_cc =0;
        $email_ciudadano_comentario->save();

        $notificacion_ciud = DB::select("select u.email, u.name, u.apellidos, s.* 
                                         FROM solucions s, actor_solucion asl, user_institucions ui, users u 
                                         where s.id=asl.solucion_id and ui.institucion_id = asl.institucion_id 
                                         and u.id= ui.user_id and asl.tipo_actor=1 and s.id=".$solucion_id);


        /*
         *
         * select u.email, u.name, u.apellidos, s.*
                                        from solucions s
                                        inner join actor_solucion asl ON s.id=asl.solucion_id
                                        inner join user_institucions ui ON asl.institucion_id = ui.id
                                        inner join users u ON u.id= ui.user_id
                                        where s.id=
         * */

        $this->notFound($notificacion_ciud);  //REDIRECCIONA AL ERROR 404  SI EL OBJETO NO EXISTE

        $notfUsed =  $notificacion_ciud[0];
        $title = 'Comentario ciudadano referente a una propuesta ';
        $email_destino= $notificacion_ciud[0]->email;
        $nombre_completo = $notificacion_ciud[0]->name.' '.$notificacion_ciud[0]->apellidos;
        $propuesta_solucion= $notificacion_ciud[0]->propuesta_solucion;
        $fecha = date("Y-m-d");

        //$emails = ['cgallardo@mipro.gob.ec', 'xceli@senplades.gob.ec',$email_destino];
        $emails = [$email_destino];

        //$mail_from='inteligencia.contacto@gmail.com';
        Mail::send('emails.correoComentarioCd', ['title' => $title,  'mensaje_cd'=>$mensaje_cd, 'nombre_completo'=>$nombre_completo, 'fecha'=>$fecha, 'propuesta_solucion'=>$propuesta_solucion, 'mail_from'=>$mail_from], function ($message) use ($emails,$mail_from)
        {

            $message->from($mail_from, 'Secretaria de Gestión de la Política');
            //$message->to('alexpatde@gmail.com')->subject('Reporte Quincenal de Propuestas Pendientes');
            $message->to($emails)->subject('Comentario Ciudadano-Mesas de dialogo');


        });
        Flash::success("Su comentario ha sido enviado exitosamente");
        session_start();
        $_SESSION["ciudadano_evalua"] = true;

        //return view('detalle-despliegue2')->with(["solucion"=>$Solucion,"solucion_id"=>$solucion_id,"mensaje_cd"=>$mensaje_cd]);
        return redirect('/detalle-despliegue-dialogo/'.$solucion_id);

    }







    public function detalleSolucion($idSolucion,$mensaje_cd){

        $solucion = Solucion::where('solucions.id','=',$idSolucion)
            ->join('mesa_dialogo','mesa_dialogo.id','=','solucions.mesa_id')
            ->select('mesa_dialogo.*','solucions.*')
            ->first();
        //dd($solucion);

        $actoresSoluciones = ActorSolucion::where('solucion_id','=',$idSolucion)
            ->where('tipo_fuente','=',1)
            ->orderBy('tipo_actor','ASC')->get();

        // dd(count($actoresSoluciones));

        $actividades = Actividad::where('solucion_id','=',$idSolucion)
            ->where('tipo_fuente','=',1)
            ->orderBy('created_at','DESC')
            ->get();
        $actividadUltima = Actividad::where('solucion_id','=',$idSolucion)
            ->where('tipo_fuente','=',1)
            ->orderBy('created_at','DESC')
            ->first();


        return view('detalle-despliegue2')->with([
            "solucion"=>$solucion,
            "actoresSoluciones"=>$actoresSoluciones,
            "actividadUltima"=>$actividadUltima,
            "actividades"=>$actividades,"mensaje_cd"=>$mensaje_cd
        ]);
    }


    public function enviarCorreo(Request $request)
    {

        $notificacion_ciud = DB::select("SELECT nc.not_cd_email, nc.not_cd_solucion_id as solucion_id,s.propuesta_solucion, es.nombre_estado as estado_solucion, ncp.not_cdp_detalle 
                                         FROM notificacion_ciudadano nc 
                                         INNER JOIN notificacion_ciudadano_propuesta ncp ON nc.not_cd_solucion_id= ncp.not_cdp_solucion_id and ncp.not_cdp_estado=0 
                                         INNER JOIN solucions s ON s.id = nc.not_cd_solucion_id 
                                         INNER JOIN estado_solucion es ON es.id = s.estado_id
                                         order by nc.not_cd_email, nc.not_cd_solucion_id");

        $this->notFound($notificacion_ciud);  //REDIRECCIONA AL ERROR 404  SI EL OBJETO NO EXISTE


        $notfUsed =  $notificacion_ciud[0];
        $title = 'Actualización de cambios relizados en propuestas ';
        $content = $notfUsed->propuesta_solucion;

        $usuarioArray = array();
        $email_origen=$notificacion_ciud[0]->not_cd_email;
        $email_next="";
        $contador = 0;

        foreach ($notificacion_ciud as $notificacion_cambio){



            $email_next =$notificacion_cambio->not_cd_email;


            if($email_origen==$email_next)
            {
                $usuarioArray[$contador] =array($notificacion_cambio->propuesta_solucion,$notificacion_cambio->estado_solucion,$notificacion_cambio->solucion_id,$notificacion_cambio->not_cdp_detalle);
                $email_origen = $email_next;
                $contador++;
            }else{


                //$emails = [$email_origen];


                $date = date('Y-m-d');

                $view = \View::make("emails.correoNotificacionCiudadano", compact('date'))->with(['title' => $title,  'notificacionesq'=> $usuarioArray]);
                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML($view);

                // $view = \View::make($vistaurl, compact('date'))->with(["data1"=>$data1]);
                //$pdf = \App::make('dompdf.wrapper');
                //$pdf->loadHTML($view);


                //$pdf = PDF::loadView('emails.correoNotificacion', ['title' => $title,  'notificacionesq'=> $usuarioArray]);
                //return $pdf->stream('reporteQuincenal.pdf');

                Mail::send('emails.correoNotificacionHome', ['title' => $title,  'notificacionesq'=> $usuarioArray], function ($message) use ($email_origen,$pdf)
                {

                    $message->from('inteligencia.contacto@gmail.com', 'Secretaria de Gestión de la Política');

                    //$message->to('alexpatde@gmail.com')->subject('Reporte Quincenal de Propuestas Pendientes');
                    $message->to($email_origen)->subject('Notificación de cambios a las propuestas que le interesa!');
                    $message->attachData($pdf->output(), 'reporteCambiosPropuestas.pdf');

                });
                $contador=0;
                unset($usuarioArray);
                $usuarioArray = array();
                $usuarioArray[$contador] =array($notificacion_cambio->propuesta_solucion,$notificacion_cambio->estado_solucion,$notificacion_cambio->solucion_id,$notificacion_cambio->not_cdp_detalle);
                $email_origen = $email_next;


            }


        }


        //$pdf = PDF::loadView('emails.correoNotificacion', ['title' => $title,  'notificacionesq'=> $usuarioArray]);
        //return $pdf->stream('reporteQuincenal.pdf');
        $date = date('Y-m-d');

        $view = \View::make("emails.correoNotificacionCiudadano", compact('date'))->with(['title' => $title,  'notificacionesq'=> $usuarioArray]);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        Mail::send('emails.correoNotificacionHome', ['title' => $title,  'notificacionesq'=> $usuarioArray], function ($message) use ($email_origen,$pdf)
        {

            $message->from('inteligencia.contacto@gmail.com', 'Secretaria de Gestión de la Política');

            //$message->to('alexpatde@gmail.com')->subject('Reporte Quincenal de Propuestas Pendientes');
            $message->to($email_origen)->subject('Notificación de cambios a las propuestas que le interesa!');
            $message->attachData($pdf->output(), 'reporteCambiosPropuestas.pdf');

        });

        $notificacionPropuesta = DB::table('notificacion_ciudadano_propuesta')->where('not_cdp_estado', 0)->update(['not_cdp_estado' => 1]);

        return response()->json(['message' => 'Request completed']);
    }





    public function prueba()
    {
        return view('emails.correoEnviarNotificacion');
    }

}
