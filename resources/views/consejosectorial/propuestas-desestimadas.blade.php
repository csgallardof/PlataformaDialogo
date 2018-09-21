@extends('layouts.consejo-sectorial')

@section('title','Propuestas-Consejo Sectorial')


@section('content')

<!-- NOTAS ESTA ES LA PANTALLA PARA CONSEJO SECTORIAL  / SEBE PROBAR Y MODIFICAR LAS COSAS PARA MEJORAR +++ NOTA +++++  -->
		<!-- begin #content -->
		<!-- begin #content -->
        <div id="content" class="content" width="10%">
            <!-- begin row -->
            <div class="row">
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats" style="background-color:#214974; color:white;">
						<div class="stats-info">
							
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats" style="background-color:#214974; color:white;">
						<div class="stats-info">
							
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats" style="background-color:#214974; color:white;">
						<div class="stats-info">
							
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats" style="background-color:#214974; color:white;">
						<div class="stats-info">
							<h4>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
			</div>

            @include('flash::message')

            
            <div class="row">
                <!-- begin col-8 -->
                
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
                            <h3 align="left" class="panel-title">Propuestas de Solución Desestimadas</h3>
                        </div>

                        <div class="panel-body">

                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            
                                            <th>Soluci&oacute;n</th>
                                            <th>Institucion</th>
                                            <th>Responsabilidad</th>
                                            <th>Calificación</th>
                                            <th>Estado</th>
                                            <th>Acci&oacute;n</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $resultados_propuestas as $resultados_propuesta )
                                        <tr>
                                            <td class="text-justify">
                                                {{ $resultados_propuesta->id}}
                                            </td>
                                            
                                            <td class="text-justify">
                                                {{ $resultados_propuesta->propuesta_solucion}}
                                            </td>
                                            <td class="text-justify">
                                                {{ $resultados_propuesta->siglas_institucion}}
                                            </td>
                                            <td class="text-justify">
                                                @if($resultados_propuesta->tipo_actor=1)
                                                	Responsable
                                                @else
                                                	Co-responsable
                                                @endif
                                            </td>
                                            <td class="text-justify">
                                                
                                            </td>
                                            <td class="text-justify">
                                               @if($resultados_propuesta->nombre_estado=="Finalizado")
                                                    <span class="label label-success f-s-12"  style="background-color: #28B463">                
                                                            {{$resultados_propuesta->nombre_estado}}
                                                    </span>
                                                            
                                                @endif

                                                @if($resultados_propuesta->nombre_estado=="En Desarrollo")
                                                <span class="label label-default f-s-12" style="background-color: #CA6F1E">{{$resultados_propuesta->nombre_estado}}</span>
                                                    
                                                @endif

                                                @if($resultados_propuesta->nombre_estado=="En Análisis")
                                                <span class="label label-default f-s-12" style="background-color: #A6ACAF">{{$resultados_propuesta->nombre_estado}}</span>
                                                    

                                                @endif
                                            </td>
                                            <td class="text-justify">
                                               
                                                <a href="{{ route('verSolucion.despliegueConsejo',[1,$resultados_propuesta->id]) }}" class="btn btn-link f-s-13 f-w-500"><i class="fa fa-2x fa-eye"></i></a>

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
                <!-- end col-10 -->

                
            </div>
            <!-- end row -->
        </div>
        <!-- end #content -->
		

		@stop
