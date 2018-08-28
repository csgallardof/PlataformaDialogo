@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Usuario<a href="{{ route('usuario.create') }}" class="btn btn-primary pull-right">Nuevo</a></div>

                <div class="panel-body">
                    <form  action="{{route('usuario.index')}}">
                    <div class="form-group">
                        <input class ="form-control"  name="search"/>
                    </div>
                    <button type="submit" class="btn btn-default">Buscar</button>
                    </form>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nombres - Apellidos</th>
                                <th>C&eacute;dula</th>
                                <th>Email</th>
                                <th>Tel&eacute;fono Celular</th>
                                <th>Tel&eacute;fono Convencional</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $usuario)
                            <tr>
                                <td>
                                    {{ $usuario-> name}} {{ $usuario-> apellidos}}
                                </td>
                                <td>
                                    {{ $usuario-> cedula}}
                                </td>
                                <td>
                                    {{ $usuario-> email}}
                                </td>
                                 <td>
                                    {{ $usuario-> telefono}}
                                </td>
                                 <td>
                                    {{ $usuario-> celular}}
                                </td>
                                <td><a href="{{ 'editar-usuario/'.$usuario->id.'/edit' }}" class="btn btn-primary">Editar</a>  
                                <!-- <a href="" class="btn btn-danger">Eliminar</a> -->
                                </td>
                            </tr>
                            @endforeach                 
                        </tbody>
                    </table>
                    {{ $instituciones->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
</div>
@endsection