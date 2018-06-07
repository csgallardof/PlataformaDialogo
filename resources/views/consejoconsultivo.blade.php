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

          <br /><br />
					<div class="modal-header">
							<h4 class="modal-title">Buscar propuestas, compromisos y acciones del <b>Consejo Consultivo Productivo Tributario</b></h4>
					</div>
					
					<!-- begin row -->
					<div class="row">
							<!-- begin col-4 -->
						<div class="col-md-12">
							<div class="panel bg-yellow">
								<div class="panel-body bg-yellow">
									<h3 class="text-white"><strong>Consultar</strong></h3>
										<br>

									<form class="form-horizontal form-bordered" action = "{{ url('consejoconsultivo') }}" method="POST">

										 {{ csrf_field() }}
										<div class="col-md-5">
											<select class="form-control" name = "sectores" data-size="15" data-live-search="true" data-style="btn-info" required>
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

										<div class="col-md-4">

											<select class="form-control" name = "ambitos" data-size="15" data-live-search="true" data-style="btn-info" required>
											<option value="0">Seleccione un &Aacute;mbito</option>

											@foreach($ambits as $ambito)

													@if(isset($paramAmbit))
													@if($ambito->id == $paramAmbit->id)
														<option value="{{ $ambito->id }}" selected="" > {{ $ambito->nombre_ambit }}</option>
													@else
														<option value="{{ $ambito->id }}" > {{ $ambito->nombre_ambit }}</option>
													@endif
												@else
													<option value="{{ $ambito->id }}" > {{ $ambito->nombre_ambit }}</option>
												@endif

											@endforeach


											</select>

										</div>

										<div class="col-md-1 ">
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
											
											@if( isset($paramSector) && isset($paramAmbit) )
												<label class='text-success f-s-12'>
													@if( $paramSector-> id > 0  && $paramAmbit->id > 0)
														<strong>Sector: </strong> {{ $paramSector->nombre_sector}} | <strong>Provincia: </strong> {{ $paramAmbit->nombre_ambit  }}
													@endif
												</label><hr>
											@endif

											@if( isset($paramSector) && !isset($paramAmbit)  )
												<label class='text-success f-s-12'>
													@if( $paramSector-> id > 0 )
														<strong>Sector: </strong> {{ $paramSector->nombre_sector}} 
													@endif
												</label><hr>
											@endif

											@if( isset($paramAmbit) && !isset($paramSector) )
												<label class='text-success f-s-12'>
													@if( $paramAmbit-> id > 0)
														<strong>Provincia: </strong> {{ $paramAmbit->nombre_ambit  }}
													@endif
												</label><hr>
											@endif


											


											<h4 class="modal-title fit-m-t-2">Cadena Productiva </h4>

										</div>
										<div class="modal-body">
										<!--INICIO ROW-->

										<!-- begin row -->
											<div class="row">
											
												<!-- PROVEEDORES INICIO -->
												<div class="col-md-3">
													<div class="panel panel-inverse overflow-hidden">
														<div class="panel-heading bg-yellow">
															<h3 class="panel-title"  style="padding:5px 10px;">
																<a class="">
																	<i class="fa fa-2x fa-arrow-right pull-right"></i>
																	<strong class="text-white f-s-13">
																	PROVEEDORES
																	</strong>
																</a>
															</h3>
														</div>
														<div id="collapse10" class="panel-collapse">
															<div class="panel-body custom-m-padding">
																<label class='text-success f-s-12 m-t-2 f-w-500'>Resultados: </label>

																	@if(isset($pajustada_sol_proveedores))
																		@if( count($pajustada_sol_proveedores) > 0)
																			{{	count($pajustada_sol_proveedores) }}
																		@else
																			{{ "0"}}
																		@endif
																	@else
																		{{ "0"}}
																	@endif
																<hr class='hr_style2' />
																<table>
																	@if(isset($pajustada_sol_proveedores))
																	@foreach($pajustada_sol_proveedores as $pajustada_sol_p)
																	<tr>
																		<td>
																			<p class="f-s-12 text-justify">
																			{{ $pajustada_sol_p->nombre_pajustada }}
																				<label class='text-success f-s-12 m-t-2 f-w-500'></label><br>
																					@if( !is_null($paramSector) && !is_null($paramAmbit) )
																						<a href= "/detalle-ccpt/{{ $pajustada_sol_p->id }}/{{ $paramSector-> id }}/{{ $paramAmbit-> id }}/1" title="Requerimiento" class="label label-primary" >
																							Ver m&aacute;s..
																						</a>
																					@endif
																					@if( !is_null($paramSector) && is_null($paramAmbit) )
																						<a href= "/detalle-ccpt/{{ $pajustada_sol_p->id }}/{{ $paramSector-> id }}/0/1" title="Requerimiento" class="label label-primary" >
																							Ver m&aacute;s..
																						</a>
																					@endif
																					@if( is_null($paramSector) && !is_null($paramAmbit) )
																						<a href= "/detalle-ccpt/{{ $pajustada_sol_p->id }}/0/{{ $paramAmbit-> id }}/1" title="Requerimiento" class="label label-primary" >
																							Ver m&aacute;s..
																						</a>
																					@endif
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
											<!--PROVEEDORES FIN  -->

											<!-- INSUMOS INICIO -->
												<div class="col-md-2">
													<div class="panel panel-inverse overflow-hidden">
														<div class="panel-heading bg-yellow">
															<h3 class="panel-title"  style="padding:5px 10px;">
																<a class="">
																	<i class="fa fa-2x fa-arrow-right pull-right"></i>
																	<strong class="text-white f-s-13">
																	INSUMOS
																	</strong>
																</a>
															</h3>
														</div>
														<div id="collapse10" class="panel-collapse">
															<div class="panel-body custom-m-padding">
																<label class='text-success f-s-12 m-t-2 f-w-500'>Resultados: </label>
																	@if(isset($pajustada_sol_insumo))
																		@if( count($pajustada_sol_insumo) > 0)
																			{{	count($pajustada_sol_insumo) }}
																		@else
																			{{ "0"}}
																		@endif
																	@else
																		{{ "0"}}
																	@endif
																<hr class='hr_style2' />
																<table>
																	@if(isset($pajustada_sol_insumo))
																	@foreach($pajustada_sol_insumo as $pajustada_sol_insu)
																	<tr>
																		<td>
																			<p class="f-s-12 text-justify">
																			{{ $pajustada_sol_insu->nombre_pajustada }}
																				<label class='text-success f-s-12 m-t-2 f-w-500'></label><br>
																					@if( !is_null($paramSector) && !is_null($paramAmbit) )
																						<a href= "/detalle-ccpt/{{ $pajustada_sol_insu->id }}/{{ $paramSector-> id }}/{{ $paramAmbit-> id }}/2" title="Requerimiento" class="label label-primary" >
																							Ver m&aacute;s..
																						</a>
																					@endif
																					@if( !is_null($paramSector) && is_null($paramAmbit) )
																						<a href= "/detalle-ccpt/{{ $pajustada_sol_insu->id }}/{{ $paramSector-> id }}/0/2" title="Requerimiento" class="label label-primary" >
																							Ver m&aacute;s..
																						</a>
																					@endif
																					@if( is_null($paramSector) && !is_null($paramAmbit) )
																						<a href= "/detalle-ccpt/{{ $pajustada_sol_insu->id }}/0/{{ $paramAmbit-> id }}/2" title="Requerimiento" class="label label-primary" >
																							Ver m&aacute;s..
																						</a>
																					@endif
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
											<!--INSUMOS FIN  -->

											<!-- PROCESOS INICIO -->
												<div class="col-md-2">
													<div class="panel panel-inverse overflow-hidden">
														<div class="panel-heading bg-yellow">
															<h3 class="panel-title"  style="padding:5px 10px;">
																<a class="">
																	<i class="fa fa-2x fa-arrow-right pull-right"></i>
																	<strong class="text-white f-s-13">
																	PROCESOS
																	</strong>
																</a>
															</h3>
														</div>
														<div id="collapse10" class="panel-collapse">
															<div class="panel-body custom-m-padding">
																<label class='text-success f-s-12 m-t-2 f-w-500'>Resultados: </label>
																	@if(isset($pajustada_sol_proceso))
																		@if( count($pajustada_sol_proceso) > 0)
																			{{	count($pajustada_sol_proceso) }}
																		@else
																			{{ "0"}}
																		@endif
																	@else
																		{{ "0"}}
																	@endif
																<hr class='hr_style2' />
																<table>
																	@if(isset($pajustada_sol_proceso))
																	@foreach($pajustada_sol_proceso as $pajustada_sol_proc)
																	<tr>
																		<td>
																			<p class="f-s-12 text-justify">
																			{{ $pajustada_sol_proc->nombre_pajustada }}
																				<label class='text-success f-s-12 m-t-2 f-w-500'></label><br>
																					@if( !is_null($paramSector) && !is_null($paramAmbit) )
																						<a href= "/detalle-ccpt/{{ $pajustada_sol_proc->id }}/{{ $paramSector-> id }}/{{ $paramAmbit-> id }}/3" title="Requerimiento" class="label label-primary" >
																							Ver m&aacute;s..
																						</a>
																					@endif
																					@if( !is_null($paramSector) && is_null($paramAmbit) )
																						<a href= "/detalle-ccpt/{{ $pajustada_sol_proc->id }}/{{ $paramSector-> id }}/0/3" title="Requerimiento" class="label label-primary" >
																							Ver m&aacute;s..
																						</a>
																					@endif
																					@if( is_null($paramSector) && !is_null($paramAmbit) )
																						<a href= "/detalle-ccpt/{{ $pajustada_sol_proc->id }}/0/{{ $paramAmbit-> id }}/3" title="Requerimiento" class="label label-primary" >
																							Ver m&aacute;s..
																						</a>
																					@endif
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
											<!--PROCESOS FIN  -->

											<!-- PRODUCTO INICIO -->
												<div class="col-md-2">
													<div class="panel panel-inverse overflow-hidden">
														<div class="panel-heading bg-yellow">
															<h3 class="panel-title"  style="padding:5px 10px;">
																<a class="">
																	<i class="fa fa-2x fa-arrow-right pull-right"></i>
																	<strong class="text-white f-s-13">
																	PRODUCTO
																	</strong>
																</a>
															</h3>
														</div>
														<div id="collapse10" class="panel-collapse">
															<div class="panel-body custom-m-padding">
																<label class='text-success f-s-12 m-t-2 f-w-500'>Resultados: </label>
																	@if(isset($pajustada_sol_producto))
																		@if( count($pajustada_sol_producto) > 0)
																			{{	count($pajustada_sol_producto) }}
																		@else
																			{{ "0"}}
																		@endif
																	@else
																		{{ "0"}}
																	@endif
																<hr class='hr_style2' />
																<table>
																	@if(isset($pajustada_sol_producto))
																	@foreach($pajustada_sol_producto as $pajustada_sol_prod)
																	<tr>
																		<td>
																			<p class="f-s-12 text-justify">
																			{{ $pajustada_sol_prod->nombre_pajustada }}
																				<label class='text-success f-s-12 m-t-2 f-w-500'></label><br>
																					@if( !is_null($paramSector) && !is_null($paramAmbit) )
																						<a href= "/detalle-ccpt/{{ $pajustada_sol_prod->id }}/{{ $paramSector-> id }}/{{ $paramAmbit-> id }}/4" title="Requerimiento" class="label label-primary" >
																							Ver m&aacute;s..
																						</a>
																					@endif
																					@if( !is_null($paramSector) && is_null($paramAmbit) )
																						<a href= "/detalle-ccpt/{{ $pajustada_sol_prod->id }}/{{ $paramSector-> id }}/0/4" title="Requerimiento" class="label label-primary" >
																							Ver m&aacute;s..
																						</a>
																					@endif
																					@if( is_null($paramSector) && !is_null($paramAmbit) )
																						<a href= "/detalle-ccpt/{{ $pajustada_sol_prod->id }}/0/{{ $paramAmbit-> id }}/4" title="Requerimiento" class="label label-primary" >
																							Ver m&aacute;s..
																						</a>
																					@endif
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
											<!--PRODUCTO FIN  -->

											<!-- MERCADO INICIO -->
												<div class="col-md-3">
													<div class="panel panel-inverse overflow-hidden">
														<div class="panel-heading bg-yellow">
															<h3 class="panel-title"  style="padding:5px 10px;">
																<a class="">
																	<i class="fa fa-2x fa-arrow-right pull-right"></i>
																	<strong class="text-white f-s-13">
																	MERCADO
																	</strong>
																</a>
															</h3>
														</div>
														<div id="collapse10" class="panel-collapse">
															<div class="panel-body custom-m-padding">
																<label class='text-success f-s-12 m-t-2 f-w-500'>Resultados: </label>
																	@if(isset($pajustada_sol_mercado))
																		@if( count($pajustada_sol_mercado) > 0)
																			{{	count($pajustada_sol_mercado) }}
																		@else
																			{{ "0"}}
																		@endif
																	@else
																		{{ "0"}}
																	@endif
																<hr class='hr_style2' />
																<table>
																	@if(isset($pajustada_sol_mercado))
																	@foreach($pajustada_sol_mercado as $pajustada_sol_mer)
																	<tr>
																		<td>
																			<p class="f-s-12 text-justify">
																			{{ $pajustada_sol_mer->nombre_pajustada }}
																				<label class='text-success f-s-12 m-t-2 f-w-500'></label><br>
																					@if( !is_null($paramSector) && !is_null($paramAmbit) )
																						<a href= "/detalle-ccpt/{{ $pajustada_sol_mer->id }}/{{ $paramSector-> id }}/{{ $paramAmbit-> id }}/5" title="Requerimiento" class="label label-primary" >
																							Ver m&aacute;s..
																						</a>
																					@endif
																					@if( !is_null($paramSector) && is_null($paramAmbit) )
																						<a href= "/detalle-ccpt/{{ $pajustada_sol_mer->id }}/{{ $paramSector-> id }}/0/5" title="Requerimiento" class="label label-primary" >
																							Ver m&aacute;s..
																						</a>
																					@endif
																					@if( is_null($paramSector) && !is_null($paramAmbit) )
																						<a href= "/detalle-ccpt/{{ $pajustada_sol_mer->id }}/0/{{ $paramAmbit-> id }}/5" title="Requerimiento" class="label label-primary" >
																							Ver m&aacute;s..
																						</a>
																					@endif
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
											<!--MERCADO FIN  -->


											
												
											</div>
											<!-- end row -->

											<hr />

										</div>

								

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
