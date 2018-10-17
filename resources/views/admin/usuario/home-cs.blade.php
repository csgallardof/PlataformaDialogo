@extends('layouts.consejo-sectorial')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="nuevo-usuario-institucion" class="btn btn-primary pull-right">Nuevo Usuario</a>
        </div>
        
        <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a> -->
                            </div>
                            <h3 align="left" class="panel-title">Usuarios</h3>
                        </div>

                      

                        <div class="panel-body">


                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>Nombres - Apellidos</th>
                                    <th>C&eacute;dula</th>
                                    <th>Email</th>
                                    <th>Institucion</th>
                                    <th>Telefono</th>
                                    <th>Estado</th>
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
                    <!-- end panel -->
                </div>
    </div>
</div>
@endsection