@extends('admin.rol.create')

@section('edit_titulo') Editar @endsection

@section('edit_nombre',$item->nombre_role) 
@section('edit_id',$item->id) 

@section('edit_link') Actualizar @endsection

@section('edit_Method')
    {{ method_field('PUT') }}
@endsection