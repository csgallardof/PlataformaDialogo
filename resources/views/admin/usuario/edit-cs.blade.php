@extends('layouts.consejo-sectorial')
@section('edit_titulo')Crear Usuario @endsection

@section('content')
<br>
<br><br>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">

    $(document).ready(function() {
    //set initial state.
        $("#nueva_clave").hide();
        $('#chk_cambio_pwd').change(function() {
            if(this.checked) {
               $("#nueva_clave").show();
               $("#pass").attr('required','required');
            }else{
               $("#nueva_clave").hide();
               $("#pass").removeAttr('required');

            }
               
        });
      
  });
</script>
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> 
                    <a href="/consejo-sectorial/listar-usuario" class="btn btn-primary pull-right">Regresar</a>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ '/consejo-sectorial/actualizar-usuario/'. $usuario->id.'/update'}}">
                        {{ csrf_field() }}
                        @section('edit_Method')
                        
                            @include('flash::message')
                        @show
                         <div class="form-group">
                            <label for="cedula" class="col-md-4 control-label">Institucion</label>

                            <div class="col-md-6">



                                <select class="form-control" name="institucion_id2" id="institucion_id2" disabled>
                                   @if( isset($usuarios_consejo) )
                                    @foreach( $usuarios_consejo as $usuarios_consejo)

                                    @if($institucion_usuario[0]->institucion_id == $usuarios_consejo->id)
                                       {{$ins_id=  $usuarios_consejo->id}}

                                       <option value="{{ $usuarios_consejo->id}}" selected="true">
                                     @else  
                                       <option value="{{ $usuarios_consejo->id}}" >
                                     @endif   
                                        {{ $usuarios_consejo->siglas_institucion}} /{{ $usuarios_consejo->nombre_institucion}}
                                    </option>
                                    
                                    @endforeach
                                    @endif
                                </select>
                                <input type="hidden" name="institucion_id" id="institucion_id" value="{{$ins_id}}" />
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
                            <label for="chk_cambio_pwd" class="col-md-4 control-label">Cambiar Clave</label>

                            <div class="col-md-6">
                              <input id="chk_cambio_pwd" type="checkbox" class="form-control" name="chk_cambio_pwd"  />

                            </div>
                        </div>

                        <div class="form-group" id="nueva_clave">
                            <label for="pass" class="col-md-4 control-label">Nueva Clave</label>

                            <div class="col-md-6">
                                <input id="pass" type="password" class="form-control" name="pass" placeholder="Ingrese su clave"   autofocus>

                            </div>
                        </div>

                    <div class="form-group">
                            <label for="estado" class="col-md-4 control-label">Estado</label>
                            <div class="col-md-6">
                            



                                @if($usuario->estado)
                               <label class="col-md-4 control-label" for="estado"> 
                                <input name="estado" type="radio" id="estado" value="Activo" checked="checked" />&nbsp;&nbsp;&nbsp;Activo</label>
                                <label class="col-md-4 control-label" for="estado">
                                <input name="estado" type="radio" id="estado" value="Inactivo" />&nbsp;&nbsp;&nbsp;Inactivo</label>
                                @else
                               <label class="col-md-4 control-label" for="estado"> 
                                <input name="estado" type="radio" id="estado" value="Activo" />&nbsp;&nbsp;&nbsp;Activo</label>
                                <label class="col-md-4 control-label" for="estado">
                                <input name="estado" type="radio" id="estado" value="Inactivo" checked="checked"/>&nbsp;&nbsp;&nbsp;Inactivo</label>

                                @endif 
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

