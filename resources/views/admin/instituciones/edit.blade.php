@extends('instituciones.create')

@section('edit_titulo') Editar @endsection


@section('edit_Method')
    {{ method_field('PUT') }}
@endsection

@section('edit_id',$item->id) 
@section('edit_nombre_institucion',$item->nombre_institucion) 
@section('edit_siglas_institucion',$item->siglas_institucion) 
 

@section('edit_link') Actualizar @endsection

