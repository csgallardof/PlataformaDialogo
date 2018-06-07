@extends('admin.sipocs.create')

@section('edit_titulo') Editar @endsection

@section('edit_nombre',$item->nombre_sipoc) 
@section('edit_id',$item->id) 

@section('edit_Method')
    {{ method_field('PUT') }}
@endsection