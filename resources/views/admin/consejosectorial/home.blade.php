@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Lista Consejos Sectorial <a href="{{ route('consejosSectoriales.create') }}" class="btn btn-primary pull-right">Nuevo</a></div>
                <div class="panel-body">
                    <form  action="{{route('consejosSectoriales.index')}}">
                        <div class="form-group">
                            <input class ="form-control"  name="search"/>
                        </div>
                        <button type="submit" class="btn btn-default">Buscar</button>
                    </form>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($consejosSectoriales as $consejoSectorial)
                            <tr>
                                <td>{{ $consejoSectorial->id }}</td>
                                <td>{{ $consejoSectorial->nombre_consejo }}</td>
                                <td><a href="{{ '/editar-consejo-sectorial/'.$consejoSectorial->id.'/edit' }}" class="btn btn-primary">Editar</a>  <a href="" class="btn btn-danger">Eliminar</a></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                     {{$consejosSectoriales->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
</div>


@endsection
