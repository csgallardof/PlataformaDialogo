@extends('consejosectorial.create')

@section('edit_titulo') Editar @endsection

@section('edit_nombre_consejo',$item->nombre_consejo) 
@section('edit_id',$item->id) 

@section('edit_link') Actualizar @endsection

@section('edit_Method')
    {{ method_field('PUT') }}
@endsection