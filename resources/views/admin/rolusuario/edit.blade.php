@extends('layouts.app')
@section('edit_titulo')Registrar @endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar Rol - Usuario                </div>
                <div class="panel-body">

<form class="form-horizontal" method="POST" action="/admin/editar-rol-usuario/{{$rolUsuario->id}}"
                    >
                           {{ csrf_field() }}
                        @section('edit_Method')
                        @show
                         <div class="form-group">
                         <label for="usuario_id" class="col-md-4 control-label">Usuario</label>

                            <div class="col-md-6">
                                
                                 {{$usuario->name}} {{$usuario->apellidos}}

                            </div>
                          
                        </div>

                        <div class="form-group">
                                 <label for="roles_id" class="col-md-4 control-label">Roles</label>

                            <div class="col-md-6">

                                <select class="form-control" name="rol_id" id="rol_id">

                                    @if( isset($roles) )
                                    @foreach( $roles as $roles )
                                    <option value="{{ $roles->id }}" {{ $roles->id == $rol->id ? 'selected="selected"' : '' }}>{{ $roles->nombre_role }}</option>    

                                    @endforeach

                                    @endif
                                </select>
                            </div>
                                 
                           <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    Agregar
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
