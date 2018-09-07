@extends('admin.mesadialogo.create')

@section('edit_titulo') Editar @endsection

<!-- setear los valores de los campos a editar -->
@section('edit_id',$item->id) 
@section('edit_nombre',$item->nombre)       
@section('edit_tipo_dialogo_id',$item->tipo_dialogo_id)
@section('edit_organizador_id',$item->organizador_id)
@section('edit_consejo_sectorial_id',$item->consejo_sectorial_id)
@section('edit_lider',$item->lider)
@section('edit_coordinador',$item->coordinador)
@section('edit_sistematizador',$item->sistematizador)
@section('edit_zona_id',$item->zona_id)
@section('edit_provincia_id',$item->provincia_id)
@section('edit_canton_id',$item->canton_id)
@section('edit_parroquia_id',$item->parroquia_id)
@section('edit_lugar',$item->lugar)
@section('edit_organizacion',$item->organizacion)
@section('edit_sector_id',$item->sector_id)
@section('edit_fecha',$item->fecha)
@section('edit_descripcion',$item->descripcion)

@section('edit_Method')
    {{ method_field('PUT') }}
@endsection