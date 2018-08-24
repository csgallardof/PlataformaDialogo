@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Rol Usuario<a href="{{ route('rolUsuario.create') }}" class="btn btn-primary pull-right">Nuevo</a></div>
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
                                <th>Acciones</th>
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
                            <td> <a   class="btn btn-primary pull-left m-b-30 m-l-30" href="/admin/editar-rol-usuario/{{$datos->id}}">Editar</a> 
                            </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $listaRolUsuario->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
</div>


@endsection
