@extends('layouts.app')
@section('edit_titulo')Registrar @endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Cambiar Contrase&ntilde;a  - Usuario  </div>
                <div class="panel-body">

                   
<form class="form-horizontal" method="POST" action="/admin/cambiar-clave/{{$usuario->id}}"   >
                           {{ csrf_field() }}
                        @section('edit_Method')
                        @show
                        @include('flash::message')
                         <div class="form-group">
                         <label for="usuario_id" class="col-md-4 control-label">Usuario</label>

                            <div class="col-md-6">
                                
                                 {{$usuario->name}} {{$usuario->apellidos}}

                            </div>

                         </div>

                     
                        <div class="form-group">
                            <label for="clave1" class="col-md-4 control-label">Contrase&ntilde;a nueva</label>

                            <div class="col-md-6">
                                
                                <input id="clave1" type="password" class="form-control" name="clave1" placeholder="Ingrese la contraseña" required value="@if(isset($usuario))@yield('password')@endif"  autofocus>
    
                            </div>
                          
                        </div>

                        <div class="form-group">
                            <label for="clave2" class="col-md-4 control-label">Repita la Contrase&ntilde;a</label>

                            <div class="col-md-6">
                                
                                <input id="clave2" type="password" class="form-control" name="clave2" placeholder="Repita la contraseña" required value="@if(isset($usuario))@yield('password')@endif"  autofocus>
    
                            </div>
                          
                        </div>


                       

  <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                     Guardar
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


@endsection
