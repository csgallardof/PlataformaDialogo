@extends('layouts.consejo-sectorial')
@section('edit_titulo')Crear Usuario @endsection

@section('content')
<br>
<br><br><br>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@yield('edit_titulo') <a href="listar-usuario" class="btn btn-primary pull-right">Regresar</a>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('guardarUsuarioConsejo')}}"
                    >
                        {{ csrf_field() }}
                        @section('edit_Method')


                        @show

                        <input type="hidden" name="crear_usuario_consejo" value="1">

                        <div class="form-group">
                            <label for="cedula" class="col-md-4 control-label">Institucion</label>

                            <div class="col-md-6">
                                <select class="form-control" name="institucion_id" id="institucion_id">

                                    @if( isset($usuario_consejo) )
                                    @foreach( $usuario_consejo as $usuario_consejo)
                                    <option value="{{ $usuario_consejo->id}}">
                                        {{ $usuario_consejo->siglas_institucion}} /{{ $usuario_consejo->nombre_institucion}}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>

                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="nombre_usuario" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="nombre_usuario" type="text" class="form-control" name="nombre_usuario" placeholder="Ingrese su Nombre" required required value="@if(isset($item))@yield('edit_nombre_usuario')@endif"   autofocus>

                            </div>
                        </div>
                        <div class="form-group">


                            <label for="apellidos_usuario" class="col-md-4 control-label">Apellidos</label>

                            <div class="col-md-6">
                                <input id="apellidos_usuario" type="text" class="form-control" name="apellidos_usuario" placeholder="Ingrese sus Apellidos" required value="@if(isset($item))@yield('edit_apellidos_usuario')@endif"  autofocus>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cedula" class="col-md-4 control-label">C&eacute;dula</label>

                            <div class="col-md-6">
                                <input id="cedula" type="text" class="form-control" name="cedula" placeholder="Ingrese su C&eacute;dula" required value="@if(isset($item))@yield('edit_cedula_usuario')@endif"  autofocus>

                            </div>
                        </div>

                         <div class="form-group">
                            <label for="telefono" class="col-md-4 control-label">Tel&eacute;fono Convencional</label>

                            <div class="col-md-6">
                                <input id="telefono" type="text" class="form-control" name="telefono" placeholder="Ingrese su tel&eacute;fono convencional" required value="@if(isset($item))@yield('edit_telefono_usuario')@endif"  autofocus>

                            </div>
                        </div>

                         <div class="form-group">
                            <label for="celular" class="col-md-4 control-label">Tel&eacute;fono Celular</label>

                            <div class="col-md-6">
                                <input id="celular" type="text" class="form-control" name="celular" placeholder="Ingrese su tel&eacute;fono celular" required value="@if(isset($item))@yield('edit_celular_usuario')@endif"  autofocus>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" placeholder="Ingrese su email" required value="@if(isset($item))@yield('edit_email_usuario')@endif"  autofocus>

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

