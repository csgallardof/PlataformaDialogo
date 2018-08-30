@extends('layouts.consejo-sectorial')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Usuario<a href="/consejo-sectorial/nuevo-usuario-institucion/" class="btn btn-primary pull-right">Nuevo</a></div>

                <div class="panel-body">
                    
                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>Nombres - Apellidos</th>
                                    <th>C&eacute;dula</th>
                                    <th>Email</th>
                                    <th>Institucion</th>
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
                                        {{ $usuario-> siglas_institucion}}
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
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
</div>
</div>
@endsection