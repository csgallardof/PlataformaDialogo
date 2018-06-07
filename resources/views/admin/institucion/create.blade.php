@extends('layouts.app')
@section('edit_titulo')Crear Instituci&oacute;n @endsection

@section('content')
<br>
<br><br><br>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@yield('edit_titulo') <a href="{{ route('instituciones.index') }}" class="btn btn-primary pull-right">Regresar</a>
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('instituciones.store') }}@if(isset($item))/@yield('edit_id')@endif"
                    >
                        {{ csrf_field() }}
                        @section('edit_Method')
                        @show
                        
                        <div class="form-group">
                            <label for="nombre_user" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="nombre_user" type="text" class="form-control" name="nombre_user" placeholder="Nombre de Instituci&oacute;n" required required value="@if(isset($item))@yield('edit_nombre_user')@endif"   autofocus>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" placeholder="Correo electr&oacute;nico" required value="@if(isset($item))@yield('edit_email')@endif""  autofocus>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cedula" class="col-md-4 control-label">C&eacute;dula</label>

                            <div class="col-md-6">
                                <input id="cedula" type="text" class="form-control" name="cedula" placeholder="Número de cédula" required value="@if(isset($item))@yield('edit_cédula')@endif""  autofocus>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                     Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                    @if(count($errors)>0)
                        <div class="alert alert-warning">
                            @foreach($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

