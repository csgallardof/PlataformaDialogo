@extends('layouts.cspAgenda')

@section('title','Inicio')


@section('content') 
        

        <!-- begin #content -->
        <div id="content" class="content" width="10%">
            <div class="row">
                <!-- begin col-12 -->
                <div class="col-md-12 col-sm-12">
                    <div class="widget widget-stats bg-green-darker">
                        <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                        <div class="stats-info"> 
                            <h4 class="modal-title"> <strong> AGENDA TERRITORIAL </strong> </h4>
               
                        </div>
                        <div class="stats-link">
                            <a href="javascript:;">&nbsp;</a>
                        </div>
                    </div>
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end page-header -->
            
            <!-- begin row -->
            
            <!-- end row -->
            <!-- begin row -->
            <div class="row">
                <!-- begin col-8 -->
                <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Agenda Territorial</h4>
                        </div>
                         
                        <div class="panel-body"> 
                             <form target="_blank" method="POST" id="f1" name="f1"  action="/institucion/guardarIdAgendaTerritorial/1" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <hr>
                                         <div class="form-group">



                                        <div class="col-md-6 ">
                                            <a href="/institucion/home" class="btn btn-warning ">Regresar</a>
                                            <a class="btn btn-info" id="seleccionar" onclick="seleccionar_todo();">Seleccionar todos</a>
                                            <a class="btn btn-info" id="deseleccionar" style="display: none" onclick="deseleccionar_todo();">Deseleccionar todos</a>
                                           <button type="submit"  class="btn btn-primary">Reporte Agenda Territorial</button> 

                                        </div>


                                    </div> <br>
                     
                        
                                @include('flash::message')
                            <div class="col-md-12"> 
                            <div class="table-responsive">
                                <table id="data-table" class="table  table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Institucion</th>
                                            <th>fecha Registro</th>
                                            <th>fecha Agenda</th>
                                            <th>Mes</th>
                                            <th>Semana</th>
                                            <th>Lugar</th>
                                            <th>Tipo Comunicacion</th>
                                            <th>Descripcion Tipo Agenda</th> 
                                            <th>Descripcion Impacto</th>
                                            <th>Responsable</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($agendaTerritorial as $agendaTerritorial)
                                                <tr>
                                                  <td><input type="checkbox" name="check[]" id="chk{{$agendaTerritorial->id}}" value='{{$agendaTerritorial->id}}'> </td>
                                                  <td class="text-justify">{{$agendaTerritorial->Institucion}}</td>
                                                  <td class="text-justify">{{$agendaTerritorial->FechaRegistro}}</td>

                                                  <td class="text-justify">{{$agendaTerritorial->fecha_agenda}}</td>
                                                  <td>
                                                       <?php
                                                       $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 

                                                        $mes= $meses[$agendaTerritorial->mes-1];  
                                                        ?>
                                                    {{$mes}}
                                                  </td>
                                                  <td class="text-justify">{{$agendaTerritorial->semana_anio}}</td>

                                                  
                                                   <td class="text-justify">{{$agendaTerritorial->nombre_canton}}</td>
                                                   <td class="text-justify">
                                                    @if($agendaTerritorial->tipo_comunicacional!="")
                                                    {{$agendaTerritorial->tipo_comunicacional}}
                                                    @else
                                                    No Definido
                                                    @endif
                                                    </td>
                                                   
                                                  <td class="text-justify">{!!$agendaTerritorial->descripcion_tipo_agenda!!}</td>
                                                  <td class="text-justify">{!!$agendaTerritorial->descripcion_tipo_impacto!!}</td>
                                                  <td class="text-justify">{{$agendaTerritorial->responsable}}</td>
                                                  <td >
                                        <div class="col-md-0 center">
                                        <a href="#modal-without-animation{{$agendaTerritorial->id}}"  data-toggle="modal"><i class="fa fa-2x fa-eye"></i></a>
                                        
                            
                            <div class="modal " id="modal-without-animation{{$agendaTerritorial->id}}">
                                <div class="modal-dialog ">
                                    <div class="modal-content ">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h3 class="modal-title" style="color:red">Agenda Territorial</h3>
                                        </div>
                                        <div class="modal-body">
                                            <p style="color:#212F3D;font-size:medium" align="justify">  <strong>Institucion: </strong> {{$agendaTerritorial->Institucion}} <br> <br>
                                                <strong>Responsable: </strong> {{$agendaTerritorial->responsable}} <br> <br>
                                                <strong>Fecha Agenda: </strong> {{$agendaTerritorial->fecha_agenda}} <br> <br>
                                                <strong>Provincia: </strong> {{$agendaTerritorial->nombre_provincia}} <br><br>
                                                <strong>Canton: </strong> {{$agendaTerritorial->nombre_canton}} <br><br>
                                                <strong>Lugar: </strong> {{$agendaTerritorial->lugar}} <br><br>
                                                
                                                <strong>Tipo Comunicacion: </strong> @if($agendaTerritorial->tipo_comunicacional!="")
                                                    {{$agendaTerritorial->tipo_comunicacional}}
                                                    @else
                                                    No Definido
                                                    @endif
                                                    <br><br>
                                                <strong>Tipo Agenda: </strong> {{$agendaTerritorial->TipoAgenda}} <br> <br>
                                                <strong>Descripcion  Agenda</strong> {!!$agendaTerritorial->descripcion_tipo_agenda!!} <br> <br>
                                                <strong>Impacto Tecnico/Político: </strong> {{$agendaTerritorial->ImpactoAgenda}} <br> <br>
                                                <strong>Descripcion  Impacto: </strong> {!!$agendaTerritorial->descripcion_tipo_impacto!!} <br>
                                        </p>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cerrar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>        
                </div>
                                                  </td>
                                                  
    
                                                    
                                                                                                
                                                </tr>

                                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </form>
                        </div>
                     
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-10 -->
                
                <!-- begin col-4 -->
                <div class="col-md-12" >
                    <div class="panel panel-inverse" data-sortable-id="index-6">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Notificaciones<br> (&uacute;ltima semana)</h4>
                        </div>
                        <h6 class="text-justify" style="color:green">En el caso de requerir una eliminación de una Agenda Territorial. Por favor enviar un correo a inteligencia@mipro.gob.ec </h6>
                        <div class="panel-body">
                            
                        </div>
                    </div>
                    <!-- <div class="panel panel-inverse" data-sortable-id="index-7">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">&Uacute;ltimas actividades</h4>
                        </div>
                        <div class="panel-body">
                            
                        </div>
                    </div> -->
                    
                </div>
                <!-- end col-4 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end #content -->
        
        @stop
        
        
