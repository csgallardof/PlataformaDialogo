@extends('layouts.cspReportes')

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
							<h4 class="modal-title"> <strong> Reportes Consejo Sectorial de la Producción </strong> </h4>
							<h4 class="modal-title" >{{$PeriodoSemanaCspReporte->nombre}}</h4>
							<h4 class="modal-title">({{$PeriodoSemanaCspReporte->fecha_inicio}} a {{$PeriodoSemanaCspReporte->fecha_final}})</h4>

							 <!-- begin col-6 -->
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
				<div class="col-md-12">


					<ul class="nav nav-tabs nav-tabs-inverse nav-justified nav-justified-mobile" data-sortable-id="index-2">

						<li class="active">
							<a href="#hechos" data-toggle="tab">
								<i class="fa fa-sticky-note-o m-r-5"></i>
								<span class="hidden-xs">Hechos</span>

							</a>
						</li>
						<li class="">
							<a href="#alerta" data-toggle="tab">
								<i class="fa fa-sticky-note m-r-5"></i>
								<span class="hidden-xs">Alertas</span>

							</a>
						</li>
					</ul>

					<div class="tab-content" data-sortable-id="index-3">


						<!--REPORTES DE ALERTAS-->
						<div class="tab-pane fade active in" id="hechos">
							

								<div class="row">
									<div class="col-md-12">
									<!-- <form class="navbar-form navbar-left pull-right">

									-->
									<hr>


                                        <div class="form-group pull-right">



                                        <div class="col-md-12" >
                                        	<a href="/institucion/lista-reportes-csp" class="btn btn-info">Reporte Hechos Relevantes</a>
                                        	<a href="/institucion/reportes-lineas-discursivas-csp" class="btn btn-primary">Reporte Lineas Discursivas</a>
                                        </div>


                                    </div> <br>
								

					        	<!-- </form>

					        	-->


								<table  class="table table-striped table-bordered" width="100%">

									<thead>
										{{$reportesHechos->render()}}
										<tr>
											<th>Fecha de Atencion</th>
											<th>Fecha  Registro</th>
											<th>Tema</th>
											<th>Tipo Comunicacional</th>
											<th>Periodo</th>
											<th>Fuente</th>

											<th>Institución</th>
											<th>Anexo</th>
										</tr>
									</thead>
									<tbody>

													@foreach($reportesHechos as $reportesHechos)
						                        <tr>

						                          <td class="text-justify">{{$reportesHechos->fecha_reporte}}</td>
						                          <td class="text-justify">{{$reportesHechos->FechaRegistro}}</td>
												
						                          <td class="text-justify">{{$reportesHechos->tema}}</td>
						                          <td class="text-justify">
											                 @if($reportesHechos->tipo_comunicacional!="")
									                            {{$reportesHechos->tipo_comunicacional}}
									                            @else
									                            No definido
									                            @endif
															                          </td>
						                          <td class="text-justify">{{$reportesHechos->Periodo}}</td>

						                          <td class="text-justify">{{$reportesHechos->fuente}}</td>

						                          <td class="text-justify">{{ $reportesHechos->Institucion}}</td>
						                          <td class="text-justify">
						                     	@if(($reportesHechos->anexo)!="000Ninguno")
						                          <a target="_blank" href="{{ route('descargarArchivoHechosCsp',$reportesHechos-> anexo) }} ">
															<?php
																$pos = strpos($reportesHechos-> anexo, "_-_");
																$anexo = substr($reportesHechos-> anexo, $pos+3, strlen($reportesHechos-> anexo)); // devuelve "d"
															?>

															<i class="fa fa-2x fa-download"></i>
														</a>
												@endif

						                      		</td>

						                      		<td class="text-justify">
						                      			<a href= "/institucion/visualizar-detalle-reporte-hechos/{{$reportesHechos->id}}"  title="Ver más"  >
														<i class="fa fa-2x fa-eye"></i>
													</a>
						                      		</td>

						                        </tr>

						                    		@endforeach

									</tbody>

								</table>

								</div>
								</div>

							
						</div>
						<!--FIN SOLUCIONES RESPONSABLE-->

						<!--SOLUCIONES Alertas-->
						<div class="tab-pane fade" id="alerta">
							

							<div class="row">
									<div class="col-md-12">

									<hr>


                                        <div class="form-group pull-right">



                                        <div class="col-md-12 pull-right" >
                                        	<a href="/institucion/reportes-alertas-csp" class="btn btn-info">Reporte Alertas</a>
                                        </div>


                                    </div> <br>

										<div class="col-md-12">
								
								</div>
								<table class="table table-striped table-bordered" width="100%">
									<thead>
										{{$reportesAlerta->render()}}
										<tr>
											<th>Fecha de Atencion</th>
											<th>Fecha Registro</th>
											<th>Periodo</th>
											<th>Tema</th>
											<th>Tipo Comunicacional</th>
											<th>Fuente</th>
											<th>Estado</th>
											<th>Institución</th>
											<th>Anexo</th>
											<th>Acciones</th>
											<th>Reporte Alerta</th>


										</tr>
									</thead>
									<tbody>

													@foreach($reportesAlerta as $reportesAlerta)
						                        <tr>
						                            <td class="text-justify">{{ $reportesAlerta->fecha_atencion }}</td>
						                            <td class="text-justify">{{ $reportesAlerta->FechaRegistro }}</td>
						                            <td class="text-justify">{{ $reportesAlerta->Periodo }}</td>
						                            <td class="text-justify">{{ $reportesAlerta->tema }}</td>
						                            <td class="text-justify">
											                 @if($reportesAlerta->tipo_comunicacional!="")
									                            {{$reportesAlerta->tipo_comunicacional}}
									                            @else
									                            No definido
									                            @endif
															                          </td>
						                            <td class="text-justify">
														<?php
														if(strlen($reportesAlerta->fuente)>100){
															//dd('no entre');
														$fuente = substr($reportesAlerta->fuente, 0, 100)."..";
														}else		
															$fuente=$reportesAlerta->fuente;
														?>
														 {{$fuente}}
						                            	


						                            </td>


						                             <td class="text-justify">{{ $reportesAlerta->EstadoReporte }}</td>
						                             <td class="text-justify">{{ $reportesAlerta->Institucion }}</td>
						                            <td class="text-justify">
						                            	@if(($reportesAlerta->anexo)!="000Ninguno")
														<a target="_blank" href="{{ route('descargarArchivoAlertaCsp',$reportesAlerta-> anexo) }} ">
															<?php
																$pos = strpos($reportesAlerta-> anexo, "_-_");
																$anexo = substr($reportesAlerta-> anexo, $pos+3, strlen($reportesAlerta-> anexo)); // devuelve "d"
															?>

															<i class="fa fa-2x fa-download"></i>
														</a>
														@endif

						                            </td>
						                            <td>

													<a  href= "/institucion/visualizar-acciones-alertas-general/{{$reportesAlerta->id}}">
														<i class="fa fa-2x fa-eye"></i>
													</a>

						                            </td>
						                            <td>
						                            	<a href= "/institucion/visualizar-detalle-reporte-Alertas/{{$reportesAlerta->id}}"  title="Ver más"  >
														<i class="fa fa-2x fa-eye"></i>
													</a>

						                            </td>

						                        </tr>
						                    		@endforeach

									</tbody>
								</table>

								</div>
								</div>
							
						</div>
						<!--FIN SOLUCIONES RESPONSABLE-->


					</div>

				</div>
				<!-- end col-8 -->
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
						<h6 class="notificaciones">En el caso de requerir una eliminación de un hecho, alerta o acción de alerta. Por favor enviar un correo a inteligencia@mipro.gob.ec </h6>
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
