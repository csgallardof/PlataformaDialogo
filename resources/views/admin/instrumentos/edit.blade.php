@extends('admin.instrumentos.create')

@section('edit_titulo') Editar @endsection

@section('edit_nombre',$item->nombre_instrumento) 
@section('edit_id',$item->id) 

@section('edit_link') Actualizar @endsection

@section('edit_Method')
    {{ method_field('PUT') }}
@endsection