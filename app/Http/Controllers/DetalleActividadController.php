<?php

namespace App\Http\Controllers;

use DB;
use App\DetalleActividad;

class DetalleActividadController extends Controller
{

public static function guardarDetalleActividad( $id_actividad, $id_solucion,$fecha_inicio,$fecha_fin, $usuario, $cedula){
    //dd("guardarDetalleActividad");
       $hoy = date('Y-m-d H:m'); 
     //  dd($hoy);
       $detalleActividad = new DetalleActividad;
        $detalleActividad->id_actividad = $id_actividad;
        $detalleActividad->id_solucion = $id_solucion;
        $detalleActividad->fecha_inicio = $fecha_inicio;
        $detalleActividad->fecha_fin = $fecha_fin;
        $detalleActividad->usuario = $usuario;
        $detalleActividad->cedula = $cedula;
        $detalleActividad->save();
    }
}