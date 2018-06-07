@extends('admin.institucion.create')

@section('edit_titulo') Editar @endsection


@section('edit_Method')
    {{ method_field('PUT') }}
@endsection

@section('edit_id',$item->id) 
@section('edit_nombre_user',$item->name) 
@section('edit_email',$item->email) 
@section('edit_email',$item->cedula) 

@section('edit_link') Actualizar @endsection

