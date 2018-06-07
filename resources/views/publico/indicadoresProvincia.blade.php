@extends('layouts.main')

@section('title', 'Inicio')

@section('start_css')
  @parent
  <link href="{{ asset('plugins/DataTables/css/data-table.css') }}" rel="stylesheet" />
@endsection

@section('contenido')

		<!-- begin #about -->
		<div id="about" class="content row-m-t-2" data-scrollview="true">
				<!-- begin container -->
			<div class="container" data-animation="true" data-animation-type="fadeInDown">

					<!-- begin row -->
				<div class="row">

					<div class="col-md-12">

						<!-- begin breadcrumb -->
						<ol class="breadcrumb pull-right">
							<li><a href="dashboard.php">Home</a></li>
							<li class="active">Fichas</li>
						</ol>
						<!-- end breadcrumb -->

					</div>

				</div>

			</div>

		</div>
		<!-- end container -->

			<!-- end page-header -->

			<!-- begin #about -->
			<div id="about" class="content row-m-t-2" data-scrollview="true">
					<!-- begin container -->
				<div class="container" data-animation="true" data-animation-type="fadeInDown">

					<div class="modal-header">
							<h4 class="modal-title" style="display: inline;">Indicadores por Provincia</h4>
              
					</div>

					<!-- begin row -->
					<div class="row">
							<!-- begin col-4 -->
						<div class="col-md-12">
							<div class="panel bg-yellow">

								<div class="col-md-12">
				                	<ul class="nav nav-tabs">
										<li class="active"><a href="#default-tab-1" data-toggle="tab">Costa</a></li>
										<li class=""><a href="#default-tab-2" data-toggle="tab">Sierra</a></li>
										<li class=""><a href="#default-tab-3" data-toggle="tab">Oriente</a></li>
										<li class=""><a href="#default-tab-4" data-toggle="tab">Insular</a></li>
									</ul>
									<div class="col-md-12">
										<div class="tab-content">
											<!-- COSTA-->
											<div class="tab-pane fade active in " id="default-tab-1">
												<div class="col-md-12">
													<ul class="nav nav-pills center-block text-center">
														<li class="active"><a href="#nav-pills-tab-ElOro" data-toggle="tab">El Oro</a></li>
														<li><a href="#nav-pills-tab-Esmeraldas" data-toggle="tab">Esmeraldas</a></li>
														<li><a href="#nav-pills-tab-Guayas" data-toggle="tab">Guayas</a></li>
														<li><a href="#nav-pills-tab-LosRios" data-toggle="tab">Los Ríos</a></li>
														<li><a href="#nav-pills-tab-Manabi" data-toggle="tab">Manabí</a></li>
														<li><a href="#nav-pills-tab-SantaElena" data-toggle="tab">Santa Elena</a></li>
													</ul>
												</div>

												<div class="tab-content">
													<div class="tab-pane fade active in col-md-10 col-md-offset-1" id="nav-pills-tab-ElOro">
							                            <!-- Inicio Header Provincia -->
							                            <div class="m-t-10 row">
							                            	<div class="m-t-15 col-md-6">
							                            		<i class="fa fa-2x fa-map-marker"><strong class="f-s-19">&nbsp;&nbsp;El Oro</strong></i>
							                             	</div>
							                            </div>
							                            <hr />
							                            <!-- Fin Header Provincia -->
														<div class="row fit-m-t-4">
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/eloro/grafico1.jpg') }}" alt="El Oro"/>
							                                </div>
							                                <hr>
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/eloro/grafico2.jpg') }}" alt="El Oro">
													    	</div>
													    </div>
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Esmeraldas">
							                            <!-- Inicio Header Provincia -->
							                            <div class="m-t-10 row">
							                             	<div class="m-t-15 col-md-6">
							                                	<i class="fa fa-2x fa-map-marker"><strong class="f-s-19">&nbsp;&nbsp;Esmeraldas</strong></i>
							                              	</div>
							                            </div>
							                            <hr />
							                            <!-- Fin Header Provincia -->
							                            <div class="row fit-m-t-4">
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/esmeraldas/grafico1.jpg') }}" alt="Esmeraldas"/>
							                                </div>
							                                <hr>
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/esmeraldas/grafico2.jpg') }}" alt="Esmeraldas">
													    	</div>
													    </div>
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Guayas">
							                            <!-- Inicio Header Provincia -->
							                            <div class="m-t-10 row">
							                              	<div class="m-t-15 col-md-6">
							                                	<i class="fa fa-2x fa-map-marker"><strong class="f-s-19">&nbsp;&nbsp;Guayas</strong></i>
							                              	</div>
							                            </div>
							                            <hr />
							                            <!-- Fin Header Provincia -->
							                            <div class="row fit-m-t-4">
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/guayas/grafico1.jpg') }}" alt="Guayas"/>
							                                </div>
							                                <hr>
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/guayas/grafico2.jpg') }}" alt="Guayas">
													    	</div>
													    </div>
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-LosRios">
							                            <!-- Inicio Header Provincia -->
							                            <div class="m-t-10 row">
							                              	<div class="m-t-15 col-md-6">
							                                	<i class="fa fa-2x fa-map-marker"><strong class="f-s-19">&nbsp;&nbsp;Los Ríos</strong></i>
							                              	</div>
							                            </div>
							                            <hr />
							                            <!-- Fin Header Provincia -->
							                            <div class="row fit-m-t-4">
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/losrios/grafico1.jpg') }}" alt="Los Ríos"/>
							                                </div>
							                                <hr>
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/losrios/grafico2.jpg') }}" alt="Los Ríos">
													    	</div>
													    </div>
							                            
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Manabi">
							                            <!-- Inicio Header Provincia -->
							                            <div class="m-t-10 row">
							                             	<div class="m-t-15 col-md-6">
							                                	<i class="fa fa-2x fa-map-marker"><strong class="f-s-19">&nbsp;&nbsp;Manabí</strong></i>
							                              	</div>
							                            </div>
							                            <hr />
							                            <!-- Fin Header Provincia -->
							                            <div class="row fit-m-t-4">
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/manabi/grafico1.jpg') }}" alt="Manabí"/>
							                                </div>
							                                <hr>
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/manabi/grafico2.jpg') }}" alt="Manabí">
													    	</div>
													    </div>

													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-SantaElena">
							                            <!-- Inicio Header Provincia -->
							                            <div class="m-t-10 row">
							                              	<div class="m-t-15 col-md-6">
							                               		<i class="fa fa-2x fa-map-marker"><strong class="f-s-19">&nbsp;&nbsp;Santa Elena</strong></i>
							                            	</div>
														</div>
							                            <hr />
							                            <!-- Fin Header Provincia -->
							                            <div class="row fit-m-t-4">
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/santaelena/grafico1.jpg') }}" alt="Santa Elena"/>
							                                </div>
							                                <hr>
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/santaelena/grafico2.jpg') }}" alt="Santa Elena">
													    	</div>
													    </div>
													</div>
												</div>
											</div>
											<!--FIN COSTA-->


											<!-- SIERRA-->
											<div class="tab-pane fade" id="default-tab-2">
												<div class="col-md-12">
													<ul class="nav nav-pills">
														<li class="active"><a href="#nav-pills-tab-Azuay" data-toggle="tab">Azuay</a></li>
														<li><a href="#nav-pills-tab-Bolivar" data-toggle="tab">Bolivar</a></li>
														<li><a href="#nav-pills-tab-Canar" data-toggle="tab">Cañar</a></li>
														<li><a href="#nav-pills-tab-Carchi" data-toggle="tab">Carchi</a></li>
														<li><a href="#nav-pills-tab-Cotopaxi" data-toggle="tab">Cotopaxi</a></li>
														<li><a href="#nav-pills-tab-Chimborazo" data-toggle="tab">Chimborazo</a></li>
														<li><a href="#nav-pills-tab-Imbabura" data-toggle="tab">Imbabura</a></li>
														<li><a href="#nav-pills-tab-Loja" data-toggle="tab">Loja</a></li>
														<li><a href="#nav-pills-tab-Pichincha" data-toggle="tab">Pichincha</a></li>
														<li><a href="#nav-pills-tab-SantoDomingo" data-toggle="tab">Santo Domingo</a></li>
														<li><a href="#nav-pills-tab-Tungurahua" data-toggle="tab">Tungurahua</a></li>
													</ul>
												</div>
												<div class="tab-content">
													<div class="tab-pane fade active in col-md-10 col-md-offset-1" id="nav-pills-tab-Azuay">
							                            <!-- Inicio Header Provincia -->
							                            <div class="m-t-10 row">
															<div class="m-t-15 col-md-6">
							                                  	<i class="fa fa-2x fa-map-marker"><strong class="f-s-19">&nbsp;&nbsp;Azuay</strong></i>
													    	</div>
    												    </div>
						                                <hr />
						                                <!-- Fin Header Provincia -->
							                            <div class="row fit-m-t-4">
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/azuay/grafico1.jpg') }}" alt="Azuay"/>
							                                </div>
							                                <hr>
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/azuay/grafico2.jpg') }}" alt="Azuay">
													    	</div>
													    </div>
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Bolivar">
							                            <!-- Inicio Header Provincia -->
							                            <div class="m-t-10 row">
							                            	<div class="m-t-15 col-md-6">
							                                	<i class="fa fa-2x fa-map-marker"><strong class="f-s-19">&nbsp;&nbsp;Bolivar</strong></i>
							                              	</div>
							                            </div>
							                            <hr />
							                            <!-- Fin Header Provincia -->
							                            <div class="row fit-m-t-4">
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/bolivar/grafico1.jpg') }}" alt="Bolivar"/>
							                                </div>
							                                <hr>
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/bolivar/grafico2.jpg') }}" alt="Bolivar">
													    	</div>
													    </div>
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Canar">
							                            <!-- Inicio Header Provincia -->
							                            <div class="m-t-10 row">
							                              <div class="m-t-15 col-md-6">
							                                <i class="fa fa-2x fa-map-marker"><strong class="f-s-19">&nbsp;&nbsp;Cañar</strong></i>
							                              </div>
							                            </div>
							                            <hr />
							                            <!-- Fin Header Provincia -->
							                            <div class="row fit-m-t-4">
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/canar/grafico1.jpg') }}" alt="Cañar"/>
							                                </div>
							                                <hr>
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/canar/grafico2.jpg') }}" alt="Cañar">
													    	</div>
													    </div>
							                            
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Carchi">
							                            <!-- Inicio Header Provincia -->
							                            <div class="m-t-10 row">
							                              <div class="m-t-15 col-md-6">
							                                <i class="fa fa-2x fa-map-marker"><strong class="f-s-19">&nbsp;&nbsp;Carchi</strong></i>
							                              </div>
							                              
							                            </div>
							                            <hr />
							                            <!-- Fin Header Provincia -->
							                            <div class="row fit-m-t-4">
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/carchi/grafico1.jpg') }}" alt="Carchi"/>
							                                </div>
							                                <hr>
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/carchi/grafico2.jpg') }}" alt="Carchi">
													    	</div>
													    </div>
							                            
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Chimborazo">
							                            <!-- Inicio Header Provincia -->
							                            <div class="m-t-10 row">
							                              <div class="m-t-15 col-md-6">
							                                <i class="fa fa-2x fa-map-marker"><strong class="f-s-19">&nbsp;&nbsp;Chimborazo</strong></i>
							                              </div>
							                              
							                            </div>
							                            <hr />
							                            <!-- Fin Header Provincia -->
							                            <div class="row fit-m-t-4">
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/chimborazo/grafico1.jpg') }}" alt="Chimborazo"/>
							                                </div>
							                                <hr>
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/chimborazo/grafico2.jpg') }}" alt="Chimborazo">
													    	</div>
													    </div>
							                              
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Cotopaxi">
							                            <!-- Inicio Header Provincia -->
							                            <div class="m-t-10 row">
							                              <div class="m-t-15 col-md-6">
							                                <i class="fa fa-2x fa-map-marker"><strong class="f-s-19">&nbsp;&nbsp;Cotopaxi</strong></i>
							                              </div>
							                              
							                            </div>
							                            <hr />
							                            <!-- Fin Header Provincia -->
							                            <div class="row fit-m-t-4">
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/cotopaxi/grafico1.jpg') }}" alt="Cotopaxi"/>
							                                </div>
							                                <hr>
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/cotopaxi/grafico2.jpg') }}" alt="Cotopaxi">
													    	</div>
													    </div>
							                            
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Imbabura">
							                            <!-- Inicio Header Provincia -->
							                            <div class="m-t-10 row">
							                              <div class="m-t-15 col-md-6">
							                                <i class="fa fa-2x fa-map-marker"><strong class="f-s-19">&nbsp;&nbsp;Imbabura</strong></i>
							                              </div>
							                              
							                            </div>
							                            <hr />
							                            <!-- Fin Header Provincia -->
							                            <div class="row fit-m-t-4">
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/imbabura/grafico1.jpg') }}" alt="Imbabura"/>
							                                </div>
							                                <hr>
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/imbabura/grafico2.jpg') }}" alt="Imbabura">
													    	</div>
													    </div>
							                            
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Loja">
							                            <!-- Inicio Header Provincia -->
							                            <div class="m-t-10 row">
							                              <div class="m-t-15 col-md-6">
							                                <i class="fa fa-2x fa-map-marker"><strong class="f-s-19">&nbsp;&nbsp;Loja</strong></i>
							                              </div>
							                              
							                            </div>
							                            <hr />
							                            <!-- Fin Header Provincia -->
							                            <div class="row fit-m-t-4">
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/loja/grafico1.jpg') }}" alt="Loja"/>
							                                </div>
							                                <hr>
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/loja/grafico2.jpg') }}" alt="Loja">
													    	</div>
													    </div>
							                            
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Pichincha">
							                            <!-- Inicio Header Provincia -->
							                            <div class="m-t-10 row">
							                              <div class="m-t-15 col-md-6">
							                                <i class="fa fa-2x fa-map-marker"><strong class="f-s-19">&nbsp;&nbsp;Pichincha</strong></i>
							                              </div>
							                              
							                            </div>
							                            <hr />
							                            <!-- Fin Header Provincia -->
							                            <div class="row fit-m-t-4">
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/pichincha/grafico1.jpg') }}" alt="Pichincha"/>
							                                </div>
							                                <hr>
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/pichincha/grafico2.jpg') }}" alt="Pichincha">
													    	</div>
													    </div>
							                            
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-SantoDomingo">
							                            <!-- Inicio Header Provincia -->
							                            <div class="m-t-10 row">
							                              <div class="m-t-15 col-md-6">
							                                <i class="fa fa-2x fa-map-marker"><strong class="f-s-19">&nbsp;&nbsp;Santo Domingo</strong></i>
							                              </div>
							                              
							                            </div>
							                            <hr />
							                            <!-- Fin Header Provincia -->
							                            <div class="row fit-m-t-4">
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/santodomingo/grafico1.jpg') }}" alt="Santo Domingo"/>
							                                </div>
							                                <hr>
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/santodomingo/grafico2.jpg') }}" alt="Santo Domingo">
													    	</div>
													    </div>
							                            
													</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Tungurahua">
							                            <!-- Inicio Header Provincia -->
							                            <div class="m-t-10 row">
							                              <div class="m-t-15 col-md-6">
							                                <i class="fa fa-2x fa-map-marker"><strong class="f-s-19">&nbsp;&nbsp;Tungurahua</strong></i>
							                              </div>
							                              
							                            </div>
							                            <hr />
							                            <!-- Fin Header Provincia -->
							                            <div class="row fit-m-t-4">
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/tungurahua/grafico1.jpg') }}" alt="Tungurahua"/>
							                                </div>
							                                <hr>
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/tungurahua/grafico2.jpg') }}" alt="Tungurahua">
													    	</div>
													    </div>
							                            
													</div>

												</div>
											</div>
											<!-- FIN SIERRA-->

											<!-- ORIENTE-->
											<div class="tab-pane fade" id="default-tab-3">
												<div class="col-md-12">
													<ul class="nav nav-pills">
														<li class="active"><a href="#nav-pills-tab-MoronaSantiago" data-toggle="tab">Morona Santiago</a></li>
														<li><a href="#nav-pills-tab-Napo" data-toggle="tab">Napo</a></li>
														<li><a href="#nav-pills-tab-Orellana" data-toggle="tab">Orellana</a></li>
														<li><a href="#nav-pills-tab-Pastaza" data-toggle="tab">Pastaza</a></li>
														<li><a href="#nav-pills-tab-Sucumbios" data-toggle="tab">Sucumbios</a></li>
														<li><a href="#nav-pills-tab-ZamoraChinchipe" data-toggle="tab">Zamora Chinchipe</a></li>
													</ul>
												</div>
												<div class="tab-content">
													<div class="tab-pane fade active in col-md-10 col-md-offset-1" id="nav-pills-tab-MoronaSantiago">
							                            <!-- Inicio Header Provincia -->
							                            <div class="m-t-10 row">
							                            	<div class="m-t-15 col-md-6">
							                                	<i class="fa fa-2x fa-map-marker"><strong class="f-s-19">&nbsp;&nbsp;Morona Santiago</strong></i>
							                              	</div>
							                            </div>
							                            <hr />
							                            <!-- Fin Header Provincia -->
							                            <div class="row fit-m-t-4">
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/moronasantiago/grafico1.jpg') }}" alt="Morono Santiago"/>
							                                </div>
							                                <hr>
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/moronasantiago/grafico2.jpg') }}" alt="Morono Santiago">
													    		/grafico2.jpg') }}" alt="">
													    	</div>
													    </div>
                            						
                            						</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Napo">
							                            <!-- Inicio Header Provincia -->
							                            <div class="m-t-10 row">
							                            	<div class="m-t-15 col-md-6">
							                                	<i class="fa fa-2x fa-map-marker"><strong class="f-s-19">&nbsp;&nbsp;Napo</strong></i>
							                              	</div>
							                            </div>
							                            <hr />
							                            <!-- Fin Header Provincia -->
							                            <div class="row fit-m-t-4">
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/napo/grafico1.jpg') }}" alt="Napo"/>
							                                </div>
							                                <hr>
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/napo/grafico2.jpg') }}" alt="Napo">
													    	</div>
													    </div>
                            
                            						</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Orellana">
							                            <!-- Inicio Header Provincia -->
							                            <div class="m-t-10 row">
							                              	<div class="m-t-15 col-md-6">
							                                	<i class="fa fa-2x fa-map-marker"><strong class="f-s-19">&nbsp;&nbsp;Orellana</strong></i>
							                              	</div>
							                            </div>
							                            <hr />
							                            <!-- Fin Header Provincia -->
							                            <div class="row fit-m-t-4">
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/orellana/grafico1.jpg') }}" alt="Orellana"/>
							                                </div>
							                                <hr>
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/orellana/grafico2.jpg') }}" alt="Orellana">
													    	</div>
													    </div>
                            						</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Pastaza">
							                            <!-- Inicio Header Provincia -->
							                            <div class="m-t-10 row">
							                              	<div class="m-t-15 col-md-6">
							                                	<i class="fa fa-2x fa-map-marker"><strong class="f-s-19">&nbsp;&nbsp;Pastaza</strong></i>
							                             	</div>
							                            </div>
							                            <hr />
							                            <!-- Fin Header Provincia -->
							                            <div class="row fit-m-t-4">
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/pastaza/grafico1.jpg') }}" alt="Pastaza"/>
							                                </div>
							                                <hr>
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/pastaza/grafico2.jpg') }}" alt="Pastaza">
													    	</div>
													    </div>
                            						</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-Sucumbios">
							                            <!-- Inicio Header Provincia -->
							                            <div class="m-t-10 row">
							                              	<div class="m-t-15 col-md-6">
							                                	<i class="fa fa-2x fa-map-marker"><strong class="f-s-19">&nbsp;&nbsp;Sucumbios</strong></i>
							                              	</div>
							                            </div>
							                            <hr />
							                            <!-- Fin Header Provincia -->
							                            <div class="row fit-m-t-4">
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/sucumbios/grafico1.jpg') }}" alt="Sucumbios"/>
							                                </div>
							                                <hr>
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/sucumbios/grafico2.jpg') }}" alt="Sucumbios">
													    	</div>
													    </div>
                            						</div>
													<div class="tab-pane fade ol-md-10 col-md-offset-1" id="nav-pills-tab-ZamoraChinchipe">
							                            <!-- Inicio Header Provincia -->
							                            <div class="m-t-10 row">
							                              	<div class="m-t-15 col-md-6">
							                                	<i class="fa fa-2x fa-map-marker"><strong class="f-s-19">&nbsp;&nbsp;Zamora Chinchipe</strong></i>
							                              	</div>
							                            </div>
							                            <hr />
							                            <!-- Fin Header Provincia -->
							                            <div class="row fit-m-t-4">
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/zamorachinchipe/grafico1.jpg') }}" alt="Zamora Chinchipe"/>
							                                </div>
							                                <hr>
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/zamorachinchipe/grafico2.jpg') }}" alt="Zamora Chinchipe">
													    	</div>
													    </div>
													</div>

												</div>

											</div>
											<!--FIN ORIENTE-->


											<!-- INSULAR-->
											<div class="tab-pane fade" id="default-tab-4">
												<div class="col-md-12">
													<ul class="nav nav-pills">
														<li class="active"><a href="#nav-pills-tab-Galapagos" data-toggle="tab">Gal&aacute;pagos</a></li>
													</ul>
												</div>
												<div class="tab-content">
													<div class="tab-pane fade active in col-md-10 col-md-offset-1" id="nav-pills-tab-Galapagos">
							                            <!-- Inicio Header Provincia -->
							                            <div class="m-t-10 row">
								                            <div class="m-t-15 col-md-6">
							                                	<i class="fa fa-2x fa-map-marker"><strong class="f-s-19">&nbsp;&nbsp;Gal&aacute;pagos</strong></i>
							                              	</div>
							                            </div>
							                            <hr />
							                            <!-- Fin Header Provincia -->
							                            <div class="row fit-m-t-4">
													    	<div class="col-md-12">
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/galapagos/grafico1.jpg') }}" alt="Galápagos"/>
							                                </div>
							                                <hr>
													    	<div class="col-md-12">º
													    		<img width="60%" class="img-responsive center-block" src="{{ asset('imagenes/competitividad/graficas_por_provincia/galapagos/grafico2.jpg') }}" alt="Galápagos">
													    	</div>
													    </div>
							                            
													</div>
												</div>

											</div>
											<!--FIN INSULAR-->

										</div>
									</div>


				                </div>
							</div>
							<!-- begin page-header -->
						</div>
							<!-- end col-4 -->
					</div>
						<!-- end row -->
					<div class="row">
							<!-- begin col-4 -->
						<div class="col-md-12">
							<div class="panel bg-yellow">

							</div>
							<!-- begin page-header -->
						</div>
							<!-- end col-4 -->
					</div>
						<!-- end row -->

				</div>

			</div>
			<!-- end #about -->

			<!-- begin #about -->
			<div id="about" class="content row-m-t-2" data-scrollview="true">
					<!-- begin container -->
					<div class="container" data-animation="true" data-animation-type="fadeInDown">

							<!-- begin row -->
							<div class="row">

							</div>
							<!-- end row -->

					</div>
					<!-- end container -->
			</div>
			<!-- end #about -->

@endsection

@section('end_js')
  @parent




  <script src="{{ asset('plugins/jquery-ui/ui/minified/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ asset('plugins/DataTables/js/jquery.dataTables.js') }}"></script>
	<script src="{{ asset('plugins/DataTables/js/dataTables.responsive.js') }}"></script>
	<script src="{{ asset('js/table-manage-responsive.demo.min.js') }}"></script>
	<script src="{{ asset('js/custom-mipro.js') }}"></script>
	<script src="{{ asset('js/apps.js') }}"></script>
	<script src="{{ asset('js/dashboard.js') }}"></script>


@endsection

@section('init_scripts')

  <script>
    $(document).ready(function() {
      Dashboard.init();



    });
  </script>

@endsection
