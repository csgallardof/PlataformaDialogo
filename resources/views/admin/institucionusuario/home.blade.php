@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Instituci&oacute;n Usuario<a href="{{ route('institucionUsuarios.create') }}" class="btn btn-primary pull-right">Nuevo</a></div>
                <div class="panel-body">
                    <form  action="{{route('institucionUsuarios.index')}}">
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
                                <th>Instituci&oacute;n</th>
                                 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($institucionUsuarios as $institucionUsuario)
                            <tr>
                                <td>{{$institucionUsuario->id}}</td>
                                <td>{{$institucionUsuario->usuario->name}}</td>
                                <td>{{$institucionUsuario->institucion->nombre_institucion}}</td>
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
