@extends('admin.usuario.create')

@section('edit_titulo') Editar @endsection


@section('edit_Method')
    {{ method_field('PUT') }}
@endsection

@section('edit_id',$item->id) 
@section('edit_nombre_usuario',$item->name) 
@section('edit_apellidos_usuario',$item->apellidos)
@section('edit_cedula_usuario',$item->cedula) 

@section('edit_telefono_usuario',$item->telefono) 
@section('edit_celular_usuario',$item->celular) 
@section('edit_clave_usuario',$item->password) 
@section('edit_email_usuario',$item->email) 
 

@section('edit_link') Actualizar @endsection

