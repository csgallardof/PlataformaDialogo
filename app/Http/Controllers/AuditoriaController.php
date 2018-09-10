<?php

namespace App\Http\Controllers;

use DB;
use App\AuditoriaCambio;

class AuditoriaController extends Controller
{

public static function guardarAuditoria( $idTabla, $nombreTabla,$proceso, $usuario, $cedula, $observacion, $errores ){
	//dd("guardarAuditoria");
	   $hoy = date('Y-m-d H:m'); 
	 //  dd($hoy);
	   $auditoria = new AuditoriaCambio;
	    $auditoria->id_tabla = $idTabla;
        $auditoria->nombre_tabla = $nombreTabla;
        $auditoria->proceso = $proceso;
        $auditoria->usuario = $usuario;
        $auditoria->cedula = $cedula;
        $auditoria->observacion = $observacion;
        $auditoria->errores = $errores;
        $auditoria->fecha_cambio =  $hoy;
	   $auditoria->save();
    }
}