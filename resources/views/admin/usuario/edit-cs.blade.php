@extends('layouts.consejo-sectorial')
@section('edit_titulo')Crear Usuario @endsection

@section('content')
<br>
<br><br><br>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> <a href="/consejo-sectorial/listar-usuario" class="btn btn-primary pull-right">Regresar</a>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ '/consejo-sectorial/actualizar-usuario/'. $usuario->id.'/update'}}">
                        {{ csrf_field() }}
                        @section('edit_Method')
                         {{ $usuario->id}} 
                            @include('flash::message')
                        @show
                         <div class="form-group">
                            <label for="cedula" class="col-md-4 control-label">Institucion</label>

                            <div class="col-md-6">
                                <select class="form-control" name="institucion_id" id="institucion_id">
                                   @if( isset($usuarios_consejo) )
                                    @foreach( $usuarios_consejo as $usuarios_consejo)
                                    <option value="{{ $usuarios_consejo->id}}" >
                                        {{ $usuarios_consejo->siglas_institucion}} /{{ $usuarios_consejo->nombre_institucion}}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>

                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="nombre_usuario" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="nombre_usuario" type="text" class="form-control" name="nombre_usuario" placeholder="Ingrese su Nombre" required required value="{{ $usuario->name }}"   autofocus>

                            </div>
                        </div>
                        <div class="form-group">


                            <label for="apellidos_usuario" class="col-md-4 control-label">Apellidos</label>

                            <div class="col-md-6">
                                <input id="apellidos_usuario" type="text" class="form-control" name="apellidos_usuario" placeholder="Ingrese sus Apellidos" required value="{{ $usuario->apellidos }}"  autofocus>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cedula" class="col-md-4 control-label">C&eacute;dula</label>

                            <div class="col-md-6">
                                <input id="cedula" type="text" class="form-control" name="cedula" placeholder="Ingrese su C&eacute;dula" required value="{{ $usuario->cedula }}"  autofocus>

                            </div>
                        </div>

                         <div class="form-group">
                            <label for="telefono" class="col-md-4 control-label">Tel&eacute;fono Convencional</label>

                            <div class="col-md-6">
                                <input id="telefono" type="text" class="form-control" name="telefono" placeholder="Ingrese su tel&eacute;fono convencional" required required value="{{ $usuario->telefono }}"  autofocus>

                            </div>
                        </div>

                         <div class="form-group">
                            <label for="celular" class="col-md-4 control-label">Tel&eacute;fono Celular</label>

                            <div class="col-md-6">
                                <input id="celular" type="text" class="form-control" name="celular" placeholder="Ingrese su tel&eacute;fono celular" required required value="{{ $usuario->celular }}" autofocus>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" placeholder="Ingrese su email" required required value="{{ $usuario->email }}"  autofocus>

                            </div>
                        </div>
                    <div class="form-group">
                            <label for="estado" class="col-md-4 control-label">Estado</label>
                            <div class="col-md-6">
                               <label class="col-md-4 control-label" for="estado"> <input name="estado" type="radio" id="estado" value="Activo" />&nbsp;&nbsp;&nbsp;Activo</label>'
                                <label class="col-md-4 control-label" for="estado"><input name="estado" type="radio" id="estado" value="Inactivo" />&nbsp;&nbsp;&nbsp;Inactivo</label>'
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                              <!--<a href="{{ '/consejo-sectorial/actualizar-usuario/'. $usuario->id.'/update'}}" class="btn btn-primary"> Actualizar</a> -->
                              <input type="submit" name="" class="btn btn-primary"  value="Actualizar" /> 
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

