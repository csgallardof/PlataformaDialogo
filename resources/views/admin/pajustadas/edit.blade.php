@extends('admin.pajustadas.create')

@section('edit_titulo') Editar @endsection

@section('edit_nombre',$item->nombre_pajustada) 
@section('edit_id',$item->id) 

@section('edit_link') Actualizar @endsection

@section('edit_Method')
    {{ method_field('PUT') }}
@endsection