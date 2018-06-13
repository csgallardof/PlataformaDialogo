@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Instituciones<a href="{{ route('instituciones.create') }}" class="btn btn-primary pull-right">Nuevo</a></div>

                <div class="panel-body">
                    <form  action="{{route('instituciones.index')}}">
                    <div class="form-group">
                        <input class ="form-control"  name="search"/>
                    </div>
                    <button type="submit" class="btn btn-default">Buscar</button>
                    </form>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Instituci&oacute;n</th>
                                <th>Siglas</th>
                                <th>Acci&oacute;n</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($instituciones as $institucion)
                            <tr>
                                <td>
                                    {{ $institucion-> nombre_institucion}}
                                </td>
                                <td>
                                    {{ $institucion-> siglas_institucion}}

                                </td>

                                <td><a href="{{ 'editar-institucion/'.$institucion->id.'/edit' }}" class="btn btn-primary">Editar</a>  <a href="" class="btn btn-danger">Eliminar</a></td>
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