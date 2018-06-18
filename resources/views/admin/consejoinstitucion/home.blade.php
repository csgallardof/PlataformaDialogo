@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Consejo Sectorial - Instituci&oacute;n <a href="{{ route('consejoInstituciones.create') }}" class="btn btn-primary pull-right">Nuevo</a></div>
                <div class="panel-body">
                    <form  action="{{route('consejoInstituciones.index')}}">
                        <div class="form-group">
                            <input class ="form-control"  name="search"/>
                        </div>
                        <button type="submit" class="btn btn-default">Buscar</button>
                    </form>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Consejo Sectorial</th>
                                <th>Instituci&oacute;n</th>
                                 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($consejoInstituciones as $consejoInstitucion)
                            <tr>
                                <td>{{ $consejoInstitucion->id }}</td>
                                <td>{{ $consejoInstitucion->consejo->nombre_consejo }}</td>
                                <td>{{ $consejoInstitucion->institucion->nombre_institucion }}</td>
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
