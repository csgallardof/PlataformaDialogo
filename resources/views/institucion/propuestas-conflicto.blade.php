@extends('layouts.institucion')

@section('title','Inicio')


@section('content')


		<!-- begin #content -->
		<div id="content" class="content" width="10%">
			<!-- begin breadcrumb -->

<!-- begin row -->
			<div class="row">
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats" style="background-color:#214974; color:white;">
						<div class="stats-info">
							<h4>TOTAL DE PROPUESTAS</h4>
								@if(isset($totalPropuestas) )
									<p>{{ $totalPropuestas }}</p>
								@else
									<p>0</p>
								@endif							
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats" style="background-color:#214974; color:white;">
						<div class="stats-info">
							<h4><a href="/institucion/ver-propuestas-unificadas">PROPUESTAS AJUSTADAS</a></h4>
							@if (isset($totalPropuestaAjustada) )
								<p>{{ $totalPropuestaAjustada }}</p>
							@else
								<p>0</p>
							@endif
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats" style="background-color:#214974; color:white;">
						<div class="stats-info">
							<h4><a href="propuestas-en-conflicto">PROPUESTAS EN CONFLICTO</a></h4>
							@if (isset($totalPropuestaConflicto) )
								<p>{{ $totalPropuestaConflicto }}</p>
							@else
								<p>0</p>
							@endif
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats" style="background-color:#214974; color:white;">
						<div class="stats-info">
							<h4><a href="propuestas-desestimadas">PROPUESTAS DESESTIMADAS</a></h4>
							@if (isset($totalPropuestaDesestimada) )
								<p>{{ $totalPropuestaDesestimada }}</p>
							@else
								<p>0</p>
							@endif
						</div>
					</div>
				</div>
				<!-- end col-3 -->
			</div>
			<!-- end row -->


			<div class="panel panel-inverse">
				<div class="panel-heading">
		            <h4 class="panel-title">Propuestas en Conflicto</h4>   	
				</div>
			</div>



			<!-- begin row -->
			<div class="row">
				<!-- begin col-8 -->
				<div class="col-md-12">

					<div class="tab-pane fade active in" id="responsable">

                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered" width="100%">
                                    <thead>
										<tr>
											<th>Codigo</th>
											<th>Propuesta</th>
											<th>Estado</th>
											<th>Acción</th>
										</tr>
									</thead>
                                    <tbody>
										@if( isset($solucionesDespliegue) )

											@foreach($solucionesDespliegue as $solucionD)
												@if($solucionD->tipo_actor == 1)
													<tr>
														<td class="text-justify">{{$solucionD->id}}</td>
														<td class="text-justify">{{$solucionD->propuesta_solucion}}</td>

														<td>
															@if($solucionD->nombre_estado=="En Conflicto")
															<span class="label label-warnig f-s-12" style="background-color: #28B463">{{$solucionD->nombre_estado}}</span>
																
																	
															@endif

														</td>
														<td>
															<a href="{{ route('verSolucion.despliegue',[1,$solucionD->id]) }}" class="btn btn-link f-s-13 f-w-500">Ver detalle</a>
														</td>
													</tr>
												@endif
											@endforeach

										@endif

										

									</tbody>
                                </table>
                            </div>
                        </div>

					

				</div>
				<!-- end col-4 -->
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->

		@stop
