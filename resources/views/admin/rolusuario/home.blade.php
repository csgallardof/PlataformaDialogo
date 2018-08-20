@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Instituci&oacute;n Usuario<a href="{{ route('rolUsuario.create') }}" class="btn btn-primary pull-right">Nuevo</a></div>
                <div class="panel-body">
                    <form  action="{{route('rolUsuario.index')}}">
                        <div class="form-group">
                            <input class ="form-control" name="search"/>
                        </div>
                        <button type="submit" class="btn btn-default">Buscar</button>
                    </form>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Usuario</th>
                                <th>Rol</th>
                             </tr>
                        </thead>
                        <tbody>
                            @foreach($listaRolUsuario as $datos)
                            <tr>
                                <td>{{$datos->id}}</td>
                                
                                @foreach($listaUsuarios as $usuario)
                                    @if($datos->user_id == $usuario->id)
                                    <td>{{$usuario->name}} {{$usuario->apellidos}}</td>
                                    @endif 
                                @endforeach

                                 @foreach($listaRoles as $rol)
                                    @if($datos->role_id == $rol->id)
                                    <td>{{$rol->nombre_role}}</td>
                                    @endif 
                                  @endforeach

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
             
                </div>
            </div>
        </div>
    </div>
</div>
</div>


@endsection
