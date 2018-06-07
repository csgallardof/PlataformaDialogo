@extends('layouts.main')

@section('title', 'Inicio')

@section('start_css')
  @parent
  <link href="{{ asset('plugins/DataTables/css/data-table.css') }}" rel="stylesheet" />
@endsection

@section('contenido')

	
		<!-- <div id="about" class="content row-m-t-2" data-scrollview="true">

			<div class="container" data-animation="true" data-animation-type="fadeInDown">


				<div class="row">

					<div class="col-md-12">

						
						<ol class="breadcrumb pull-right">
							<li><a href="dashboard.php">Home</a></li>
							<li class="active">Fichas</li>
						</ol>


					</div>

				</div>

			</div>

		</div> -->


			<!-- end page-header -->

			<!-- begin #about -->
			<div id="about" class="content row-m-t-2" data-scrollview="true">
					<!-- begin container -->
				<div class="container" data-animation="true" data-animation-type="fadeInDown">

          <br /><br />
					<div class="modal-header">
							<h4 class="modal-title">Buscar propuestas, compromisos y acciones del <b>Despliegue territorial</b></h4>
					</div>
					{{-- <label class='text-success f-s-12'>
						<strong>Provincias Sistematizadas:</strong> Esmeraldas, Imbabura, Tungurahua y Loja 
					</label> --}}

					<!-- begin row -->
					<div class="row">
							<!-- begin col-4 -->
						<div class="col-md-12">
							<div class="panel bg-yellow">
								<div class="panel-body bg-yellow">
									<h3 class="text-white"><strong>Consultar</strong></h3>
										<br>

									<form class="form-horizontal form-bordered" action = "{{ url('despliegueterritorial') }}" method="POST">

										 {{ csrf_field() }}
										
										<div class="col-md-5">

											<select class="form-control" name = "provincias" data-size="15" data-live-search="true" data-style="btn-info">
											<option value="0">Seleccione una provincia</option>

											@foreach($provincias as $provincia)
												@if(isset($paramProvincia))
													@if($provincia->id == $paramProvincia->id)
														<option value="{{ $provincia->id }}" selected="" > {{ $provincia->nombre_provincia }}</option>
													@else
														<option value="{{ $provincia->id }}" > {{ $provincia->nombre_provincia }}</option>
													@endif
												@else
													<option value="{{ $provincia->id }}" > {{ $provincia->nombre_provincia }}</option>
												@endif

											@endforeach


											</select>

										</div>

										<div class="col-md-5">
											<select class="form-control" name = "sectores" data-size="15" data-live-search="true" data-style="btn-info">
											<option value="0">Seleccione el sector</option>

												@foreach($sectors as $sector)

													@if(isset($paramSector))
														@if($sector->id == $paramSector->id)
															<option value="{{ $sector->id }}" selected > {{ $sector->nombre_sector }} </option>
														@else
															<option value="{{ $sector->id }}" > {{ $sector->nombre_sector }}</option>
														@endif	
													@else
														<option value="{{ $sector->id }}" > {{ $sector->nombre_sector }}</option>
													@endif	
												@endforeach


											</select>

										</div>

										
										<div class="col-md-1">
											<button type="submit" class="btn btn-success m-r-5 m-b-5">Consultar</button>
											<input type="hidden" name="accion" value="nuevo">
										</div>

										{{-- <div class="col-md-1 m-l-10">
											<a href="add-fichas.php" class="btn btn-success m-r-5 m-b-5"><i class="fa fa-plus m-r-10"></i>Agregar</a>
										</div> --}}
									</form>
								</div>
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
									<!-- begin col-4 -->

									<!-- end row -->
								<div class="col-md-12"  style="background: #ffffff;">

									<div class="modal-header">
									
										@if( isset($paramSector) && isset($paramProvincia) )
											<label class='text-success f-s-12'>
												@if( $paramSector-> id > 0  && $paramProvincia->id > 0)
													<strong>Sector: </strong> {{ $paramSector->nombre_sector}} | <strong>Provincia: </strong> {{ $paramProvincia->nombre_provincia  }}
												@endif
											</label><hr>
										@endif

										@if( isset($paramSector) && !isset($paramProvincia)  )
											<label class='text-success f-s-12'>
												@if( $paramSector-> id > 0 )
													<strong>Sector: </strong> {{ $paramSector->nombre_sector}} 
												@endif
											</label><hr>
										@endif

										@if( isset($paramProvincia) && !isset($paramSector) )
											<label class='text-success f-s-12'>
												@if( $paramProvincia-> id > 0)
													<strong>Provincia: </strong> {{ $paramProvincia->nombre_provincia  }}
												@endif
											</label><hr>
										@endif

										<h4 class="modal-title fit-m-t-2">Cadena Productiva 
											
										</h4>

										</div>
										<div class="modal-body">
										<!--INICIO ROW-->

										<!-- begin row -->
											<div class="row">
													<!-- begin col-3 -->
												<div class="col-md-3">

													<!-- MODAL PROVEEDORES INICIO -->

													<div class="panel panel-inverse overflow-hidden">
													<div class="panel-heading bg-yellow">
														<h3 class="panel-title"  style="padding:5px 10px;">
															<a class="">
																<i class="fa fa-2x fa-arrow-right pull-right"></i>
																<strong class="text-white f-s-13">PROVEEDORES</strong>
															</a>
														</h3>
													</div>
													<div id="collapse10" class="panel-collapse">
														<div class="panel-body custom-m-padding">
														<label class='text-success f-s-12 m-t-2 f-w-500'>Resultados: </label>
														@if(isset($solucion_proveedores))
															@if( count($solucion_proveedores) > 0)
																{{	count($solucion_proveedores) }}
															@else
																{{ "0"}}
															@endif
														@else
															{{ "0"}}
														@endif
															<hr class='hr_style2' />
															<table>
																@if(isset($solucion_proveedores))
																@foreach($solucion_proveedores as $solucion_p)
																<tr>
																	<td>
																		<p class="f-s-12 text-justify">
																		{{ $solucion_p->verbo_solucion." ".$solucion_p->sujeto_solucion." ".$solucion_p->complemento_solucion }}
																			<label class='text-success f-s-12 m-t-2 f-w-500'></label><br>
																			<a href= "/detalle-despliegue/{{ $solucion_p->id }}" title="Requerimiento" class="label label-primary" >
																						Ver m&aacute;s..
																			</a>
																		</p>
																		<hr class="hr_style3" />
																	</td>

																</tr>
																@endforeach
																@endif
																
															</table>
															

														</div>
													</div>
												</div>
											</div>
													<!-- end col-3 -->
												<!--MODAL PROVEEDORES FIN  -->


												<!--MODAL INSUMOS INCIO   -->
												<div class="col-md-2">
													<div class="panel panel-inverse overflow-hidden">
													<div class="panel-heading bg-yellow">
														<h3 class="panel-title"  style="padding:5px 10px;">
															<a class="">
																<i class="fa fa-2x fa-arrow-right pull-right"></i>
																<strong class="text-white f-s-14">INSUMOS</strong>
															</a>
														</h3>
													</div>

													<div id="collapse10" class="panel-collapse">
														<div class="panel-body custom-m-padding">
														<label class='text-success f-s-12 m-t-2 f-w-500'>Resultados:</label>
														@if(isset($solucion_insumo))
															@if( count($solucion_insumo) > 0)
																{{	count($solucion_insumo) }}
															@else
																{{ "0"}}
															@endif
														@else
															{{ "0"}}
														@endif
														<hr class='hr_style2' />

															<table>
																@if(isset($solucion_insumo))
																@foreach($solucion_insumo as $solucion_insu)

																<tr>
																	<td>
																		<p class="f-s-12 text-justify">
																			{{ $solucion_insu->verbo_solucion." ".$solucion_insu->sujeto_solucion." ".$solucion_insu->complemento_solucion  }}
																			<label class='text-success f-s-12 m-t-2 f-w-500'></label><br>
																			<a href= "/detalle-despliegue/{{ $solucion_insu->id }}" title="Requerimiento" class="label label-primary" >
																						Ver m&aacute;s..
																			</a>
																		</p>
																		<hr class="hr_style3" />
																	</td>

																</tr>
																@endforeach
																@endif
																
															</table>
															

														</div>
													</div>
												</div>
											</div>

												<!-- MODAL FINAL INSUMOS  -->

												<!--MODAL PREOCESOS INCIO   -->
												<div class="col-md-2">
													<div class="panel panel-inverse overflow-hidden">
													<div class="panel-heading bg-yellow">
														<h3 class="panel-title"  style="padding:5px 10px;">
															<a class="">
																<i class="fa fa-2x fa-arrow-right pull-right"></i>
																<strong class="text-white f-s-14">PROCESOS</strong>
															</a>
														</h3>
													</div>

													<div id="collapse10" class="panel-collapse">
														<div class="panel-body custom-m-padding">
													<label class='text-success f-s-12 m-t-2 f-w-500'>Resultados: </label>
													@if(isset($solucion_proceso))
															@if( count($solucion_proceso) > 0)
																{{	count($solucion_proceso) }}
															@else
																{{ "0"}}
															@endif
														@else
															{{ "0"}}
														@endif
														<hr class='hr_style2' />
															<table>
																@if(isset($solucion_proceso))
																@foreach($solucion_proceso as $solucion_proc)
																<tr>
																	<td>
																		<p class="f-s-12 text-justify">
																			{{ $solucion_proc->verbo_solucion. " ".$solucion_proc->sujeto_solucion." ".$solucion_proc->complemento_solucion }}
																			<label class='text-success f-s-12 m-t-2 f-w-500'></label><br>
																			<a href= "/detalle-despliegue/{{ $solucion_proc->id }}" title="Requerimiento" class="label label-primary" >
																						Ver m&aacute;s..
																			</a>
																		</p>
																		<hr class="hr_style3" />
																	</td>

																</tr>
																@endforeach
																@endif
															</table>
														</div>
													</div>
												</div>

											</div>

													<!-- MODAL PROCESOS FINAL   -->

													<!--MODAL PRODUCTO INCIO   -->
												<div class="col-md-2">
													<div class="panel panel-inverse overflow-hidden">
													<div class="panel-heading bg-yellow">
														<h3 class="panel-title"  style="padding:5px 10px;">
															<a class="">
																<i class="fa fa-2x fa-arrow-right pull-right"></i>
																<strong class="text-white f-s-14">PRODUCTO</strong>
 															</a>
														</h3>
													</div>

													<div id="collapse10" class="panel-collapse">
														<div class="panel-body custom-m-padding">
														<label class='text-success f-s-12 m-t-2 f-w-500'>Resultados: </label>
														@if(isset($solucion_producto))
															@if( count($solucion_producto) > 0)
																{{	count($solucion_producto) }}
															@else
																{{ "0"}}
															@endif
														@else
															{{ "0"}}
														@endif
														<hr class='hr_style2' />

														<table>

															@if(isset($solucion_producto))
															@foreach($solucion_producto as $solucion_prod)
															<tr>
																<td>
																	<p class="f-s-12 text-justify">
																		{{ $solucion_prod->verbo_solucion. " ".$solucion_prod->sujeto_solucion." ".$solucion_prod->complemento_solucion }}
																		<label class='text-success f-s-12 m-t-2 f-w-500'></label><br>
																			<a href= "/detalle-despliegue/{{ $solucion_prod->id }}" title="Requerimiento" class="label label-primary" >
																						Ver m&aacute;s..
																			</a>
																		</p>
																	<hr class="hr_style3" />
																</td>

															</tr>
															@endforeach
															@endif
																
														</table>
														</div>
													</div>
												</div>
											</div>

												<!-- MODAL PRODUCTO FINAL  -->
												<!--MODAL MERCADO INCIO   -->
												<div class="col-md-3">
													<div class="panel panel-inverse overflow-hidden">
													<div class="panel-heading bg-yellow">
														<h3 class="panel-title"  style="padding:5px 10px;">
															<a class="">
																<i class="fa fa-2x fa-arrow-right pull-right"></i>
																<strong class="text-white f-s-14">MERCADO</strong>
															</a>
														</h3>
													</div>

													<div id="collapse10" class="panel-collapse">
														<div class="panel-body custom-m-padding">
														<label class='text-success f-s-12 m-t-2 f-w-500'>Resultados:</label>
														@if(isset($solucion_mercado))
															@if( count($solucion_mercado) > 0)
																{{	count($solucion_mercado) }}
															@else
																{{ "0"}}
															@endif
														@else
															{{ "0"}}
														@endif
															<hr class='hr_style2' />
															<table>
																@if(isset($solucion_mercado))
																@foreach($solucion_mercado as $solucion_mer)
															
																<tr>
																	<td>
																		<p class="f-s-12 text-justify">
																			{{ $solucion_mer->verbo_solucion. " ".$solucion_mer->sujeto_solucion." ".$solucion_mer->complemento_solucion }}
																			<label class='text-success f-s-12 m-t-2 f-w-500'></label><br>
																			<a href= "/detalle-despliegue/{{ $solucion_mer->id }}" title="Requerimiento" class="label label-primary" >
																						Ver m&aacute;s..
																			</a></p>
																		<hr class="hr_style3" />
																	</td>

																@endforeach
																@endif

																</tr>
																
															</table>
															

														</div>
													</div>
												</div>
											</div>

												<!-- MODAL MERCADO FINAL   -->
			
									</div>
										<!-- end row -->

										<!-- FIN ROW-->

										<!-- -->

								<hr />


								</div>

								<!-- end #content -->

								<!-- begin scroll to top btn -->
								<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
								<!-- end scroll to top btn -->
							</div>

									<!-- end col-4 -->

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
