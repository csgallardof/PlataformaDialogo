@extends('admin.consejoinstitucion.create')

@section('edit_titulo') Editar @endsection
 

@section('edit_link') Actualizar @endsection

@section('edit_Method')
    {{ method_field('PUT') }}
@endsection