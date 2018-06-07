@extends('layouts.cspReportes')

@section('title','Inicio')

@section('content')
		

<div id="content" class="content" width="10%">
            <div class="row">
                <!-- begin col-12 -->
                <div class="col-md-12 col-sm-12">
                    <div class="widget widget-stats bg-green-darker">
                        <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                        <div class="stats-info">
                            <h4 class="modal-title">Reportes Consejo Sectorial de la Producción</h4>
                            <br><br>
                            <div class="col-md-0 pull-right">
                                        <a href="#modal-without-animation"  data-toggle="modal"><i class="fa fa-2x fa-info-circle " style="color :#F7F9F9"></i></a>
                                        
                            
                            <div class="modal " id="modal-without-animation">
                                <div class="modal-dialog ">
                                    <div class="modal-content ">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h3 class="modal-title" style="color:red">Información</h3>
                                        </div>
                                        <div class="modal-body">
                                            <p style="color:#212F3D;font-size:medium" align="justify"> <strong>Hechos Relevantes</strong> <br> Eventos y/o hechos relevantes de carácter comunicacional que ocurrieron durante la semana que se reporta. No es un informe de gestión de las reuniones o actividades llevadas a cabo durante la semana de reporte, sino aquellos hechos lo suficientemente relevantes para ser puestos en conocimiento de la Presidencia de la República, tomando en cuenta el nivel de relevancia de la gestión, de política, de comunicación y de presencia en territorio. 
                                            <strong> <br>Líneas Argumentales Hechos Relevantes</strong> <br> Las líneas discursivas se elaboran sobre los hechos relevantes ocurridos durante la semana que se reporta, y la misma deberá estar escrita en pasado. Por ejemplo, “El pasado viernes 23 de febrero 2018, se inauguró la planta de aluminio de Posorja¼”. <br> 
                                            <strong>Alertas del Sector</strong> <br>Son alertas del sector que han sido identificadas, que no han podido ser resueltas internamente, por lo que necesitan ser puestas en conocimiento, y de ser necesario, buscar la intervención del Secretario General de la Presidencia, y posteriormente, del Presidente de la República. Adicionalmente, estas alertas deben anticipar cualquier noticia o nota de prensa, por lo que su objetivo es alertar a la Presidencia de la República sobre el suceso o posible problema. Por ejemplo, una alerta del sector puede ser la baja de precio de la papa en la provincia de Tungurahua, lo cual, posiblemente, genere un paro de los involucrados en la cadena de compra-venta. Las alertas reportadas deben ser reportadas todas las semanas, a menos que hayan sido resueltas en su totalidad. <br>
                                            <strong>Agenda Territorial</strong><br>Eventos de carácter comunicacional que se tiene planificado que sucedan durante el mes requerido. Aconsejamos se realice un importante hincapié en cuanto a la identificación de las Obras del Gobierno y de los eventos de carácter comunicacional, ya que los mismos serán utilizados para las grabaciones de "El Gobierno Informa". Adicionalmente,  solicitamos considerar los eventos en los que se desea se incluya una participación/saludo del Presidente de la República. No es un reporte de gestión, sino aquellos eventos relevantes.<br>
                                            <strong>Líneas Discursivas de la Agenda Territorial</strong><br>Las líneas discursivas de la Agenda Territorial deberán estar escritas en futuro. Por ejemplo, “El próximo 15 de marzo de 2018, se inaugurará la planta de aluminio de Posorja¼”.

                                            <br><br><i>NOTA1: La información debe estar validada por su máxima autoridad.</i> 
                                            <br><br><i>NOTA2: La información es de carácter sensible, y no puede contener errores de ningún tipo.</i> 
                                            <br><br><i>NOTA3: Tomar en cuenta la forma de redacción, las faltas ortográficas y el detalle de la misma.</i> 


                                        </p>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cerrar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>        
                </div>   
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
                <div class="col-md-8">
                    
                    
                    
                    
                    <div class="panel panel-inverse" >
                        <div class="panel-heading pull-righ">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Acciones Alerta del Reporte {{$cspReportesAlerta->tema}}<br> </h4>
                        </div>
                        
                        <div class="panel-body">  
                        <div id="content" class="content">
            <!-- begin breadcrumb -->
            
            
            <!-- end breadcrumb -->
            <!-- begin page-header -->
            
            <!-- end page-header -->
            
            <!-- begin invoice -->

            <div class="row">
				<!-- begin col-8 -->
				<div class="col-md-12">
					<div class="tab-content" data-sortable-id="index-3">
						

							
						
						
						
						<!--REPORTES DE ALERTAS-->
						<div class="tab-pane fade active in" id="hechos">
							<div class="height-lg" data-scrollbar="true">
								<div class="col-md-12">
								<a href="/institucion/consejo-sectorial-produccion" class="btn btn-primary pull-right">Regresar</a>
								</div>

						<hr>
															
								<div class="row">
									<div class="col-md-2"></div>
									<div class="col-md-12">
											
										

                                        {{$accionesReporteAlerta->render()}}
										
								
								<table class="table">
										
									<thead>
										<tr>
											
											<th>Fecha Accion</th>
											<th>Fecha Registro</th>
                                            <th>Periodo</th>
											<th>Acciones</th>
											<th>Anexo</th>
                                            
											
										</tr>
									</thead>
									
									
									<tbody>
										  
										      	
											@foreach($accionesReporteAlerta as $accionesReporteAlerta)
						                        <tr>
						                         
						                            <td class="text-justify">{{ $accionesReporteAlerta->fecha }}</td>
						                            <td class="text-justify">{{ $accionesReporteAlerta->created_at }}</td>
                                                    <td class="text-justify">{{ $accionesReporteAlerta->Periodo }}</td>
						                            <td class="text-justify">{!! $accionesReporteAlerta->acciones !!}</td>
													<td class="text-justify">
                                                    @if(($accionesReporteAlerta->anexo)!="000Ninguno")
														<a target="_blank" href="{{ route('descargarAccionAlertaCsp',$accionesReporteAlerta-> anexo) }} ">
															<?php
																$pos = strpos($accionesReporteAlerta-> anexo, "_-_");
																$anexo = substr($accionesReporteAlerta-> anexo, $pos+3, strlen($accionesReporteAlerta-> anexo)); // devuelve "d"
															?>

															<i class="fa fa-2x fa-download"></i>

														</a>
                                                        @endif

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
				
            <!-- end invoice -->
        </div> 
                        </div>
                    </div>                 
                    
                </div>
                <!-- end col-8 -->
                <!-- begin col-4 -->
                <div class="col-md-4" >
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
                        <h6 align="center" style="color:green"> No existe notificaciones</h6>
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
		