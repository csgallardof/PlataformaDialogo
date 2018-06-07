@extends('layouts.main')

@section('title', 'Reporte')

@section('start_css')
  @parent
  	<link href="{{ asset('plugins/DataTablesv2/datatables.css') }}" rel="stylesheet" />
	<link href="{{ asset('css/style-after.css') }}" rel="stylesheet" />

@endsection

@section('contenido')

<br><br><br><br>
	<!-- begin row -->
	<div id="about" class="content work" data-scrollview="true">
		<div class="container" data-animation="true" data-animation-type="fadeInDown">


        <div class="toolbar title_ip_breadcrumb fit-m-b-10">
          <ol class="breadcrumb">

            <li class="home"><a href="{{ url('/') }}"><i class="fa fa-home fa-lg"></i><span></span></a></li>
            <li class="active"><a href="{{ url('/busqueda?parametro=Consejo_consultivo') }}">Resultados de la B&uacute;squeda </a></li>

          </ol>
        </div>

          <div class="row fit-m-b-20">

					<form role="form" method="GET" action="{{ route('nuevaBusqueda') }}">
					 	<input type="hidden" name="parametro" value="{{ Request::get('parametro')}}">
					 	<div class="form-group">
						 	<div class="form-check form-check-inline">
						 		<!-- <?php $arraySectors[] = array(); ?>

						 		<div class="col-md-2">

							    <label for="sectorSelect">Sector</label><br>
								 	<select class="form-group form-control" id="sectorSelect" name="sectorSelect" style="width: 175px">
								 		<option value="0">Seleccionar</option>
								 		@foreach( $resultados as $solucion)
								 			@if( !in_array( $solucion->sector->id , $arraySectors) )
									 			<option value="{{ $solucion->sector->id}}">{{ $solucion->sector->nombre_sector }}</option>
									 			<?php array_push( $arraySectors, $solucion->sector->id ); ?>
									 		@endif
								 		@endforeach
								 	</select> -->

								 	<?php $arrayAmbits[] = array(); ?>

						 		<div class="col-md-2">

							    <label for="ambitoSelect">Ámbito</label><a style="font-size: 12px;text-decoration:none" href="javascript:history.back(-1);" title="Ir la página anterior" class="pull-right">Quitar Filtro</a><br>
								 	<select class="form-group form-control" id="ambitoSelect" name="ambitoSelect" style="width: 175px">
								 		<option value="0">Seleccionar</option>
								 		@foreach( $resultados as $solucion)
								 			@if( !in_array( $solucion->ambit->id , $arrayAmbits) )
								 				@if($datosFiltroAmbito!="")
								 				@if($solucion->ambit->id==$datosFiltroAmbito)
									 			<option value="{{ $solucion->ambit->id}}" selected>{{ $solucion->ambit->nombre_ambit }}</option>
									 			@endif
									 			@else
									 			<option value="{{ $solucion->ambit->id}}">{{ $solucion->ambit->nombre_ambit }}</option>
									 			@endif
									 			<?php array_push( $arrayAmbits, $solucion->ambit->id );
									 			;
									 			 ?>
									 		@endif
								 		@endforeach
								 	</select>
                </div>
                <div class="col-md-2">
								 	<?php $arrayResponsables[] = array(); ?>
								 	<label for="sectorSelect">Responsable</label><a style="font-size: 12px;text-decoration:none" href="javascript:history.back(-1);" title="Ir la página anterior" class="pull-right">Quitar Filtro</a><br>
								 	<select class="form-group form-control" id="responsableSelect" name="responsableSelect" style="width: 175px">
								 		<option value="0">Seleccionar</option>
								 		@foreach( $resultados as $solucion)
								 			@if( count($solucion->actor_solucion) > 0 )
						                		@foreach( $solucion->actor_solucion as $actorSolucion)
						                			@if( $actorSolucion->tipo_actor == 1 )
						                				@if( !in_array( $actorSolucion-> usuario-> id , $arrayResponsables) )
						                				@if($datosFiltroResponsable!="")
						                				@if($actorSolucion-> usuario-> id==$datosFiltroResponsable)
						                					<option value="{{ $actorSolucion-> usuario-> id}}" selected>{{ $actorSolucion-> usuario-> name}}</option>
						                				@endif
						                				@else
						                				<option value="{{ $actorSolucion-> usuario-> id}}">{{ $actorSolucion-> usuario-> name}}</option>
						                				@endif
						                					<?php array_push( $arrayResponsables, $actorSolucion->usuario->id ); ?>
						                				@endif
						                			@endif
						                		@endforeach
							                @endif
							            @endforeach

								 	</select>
                  </div>

                  <div class="col-md-2 m-t-25">
                    <button type="submit" class="btn btn-primary m-l-20">Filtrar </button>
                  </div>

					</form>



							    <div class="col-md-6 pull-right">

					                    <div class="panel-body text-center">

					                        <form class="form-horizontal" role="form" method="GET" action="{{ route('nuevaBusqueda') }}">

					                            <div class="form-group">

					                                <div class="input-group custom-search-form">
					                                    <input type="text" class="form-control_2" placeholder="Busca todo sobre el diálogo con el sector productivo" name="parametro" required style="font-size: 16px" >
					                                    <span class="input-group-btn">
					                                        <button class="btn btn-buscar btn-lg" style="background: #EF5D06; color: #fff; " type="submit" height="50px">
					                                            <span class="glyphicon glyphicon-search"></span>
					                                        </button>
					                                    </span>

					                                </div>

					                            </div>

					                        </form>
					                    </div>
							    </div>

							</div>
						</div>


				</div>

				<hr>

          <div class="col-md-8">
					<span class="title_ip_h1"> 

						<?php $total = 0; ?>
						@foreach ($resultados as $solucion=>$athlete)
						 	
						 <?php   $total = ++$solucion; ?>	
						@endforeach	
						{{ $total }}
					Resultados de la B&uacute;squeda</span>
						
						
						{{-- @if(isset($parametro))
							Se muestran los resultados para "
							<a href="/busqueda?parametro={{ Request::get('parametro') }}">
								<b style="color: #00acac; font-size: 16px">{{ $parametro }}</b>
							</a>
							"
						@endif --}}
				
          </div>

          <div class="col-md-4">
          	<a href="/dialogo-nacional-estadisticas" class="btn pull-right btn-success m-l-30"><i class="fa fa-line-chart"></i>&nbsp;Estadísticas</a>
           
            <a href="/descargar/Mesas" class="btn pull-right btn-success"><i class="fa fa-download"></i>&nbsp;Descargar</a>
            <div class="col-md-2">
            <form target="_blank" method="POST" action="/lista-propuesta/1" enctype="multipart/form-data">
					{{ csrf_field() }}			
									<button type="submit"  class="btn btn-primary pull-right">Reporte Propuesta</button>
						@if(isset($resultados))
							<table id="data" class="table nowrap" width="100%" hidden="">
								<thead>
									<th class="text-center" hidden="">id</th> 
									<th class="text-center">PROPUESTA</th>
					                <th class="text-center">AMBITO</th>
					                <th class="text-center">RESPONSABLE</th>
					                <th class="text-center">ESTADO</th>

					                <th></th>
								</thead>
								<tbody> 
						        	@foreach( $resultados as $solucion)
						        		<tr>
						        			
											<td hidden="">
						        				<input  type="checkbox" name="check[]" id="chk{{$solucion->id}}" checked value='{{$solucion->id}}'>
						        			</td>
											@if($solucion-> tipo_fuente == 1)
							                	<td class="text-left">{{ $solucion->verbo_solucion." ".$solucion->sujeto_solucion."  ".$solucion->complemento_solucion }}
																								
							                	</td>
							                @else
							                	@if($solucion-> tipo_fuente == 2)
							                		<td class="text-left">{{ $solucion->verbo_solucion." ".$solucion->sujeto_solucion."  ".$solucion->complemento_solucion }}</td>
							                	@endif
							                @endif
							                <td class="text-left">{{ $solucion->ambit->nombre_ambit}}</td>
							                <td class="text-center">
							                	@if( count($solucion->actor_solucion) > 0 )
							                		@foreach( $solucion->actor_solucion as $actorSolucion)
							                			@if( $actorSolucion->tipo_actor == 1 )
							                				{{ $actorSolucion-> usuario-> name}}
							                			@endif
							                		@endforeach
							                	@endif

							                </td>

											<td class="text-left">
												<span class="label label-warning f-s-13">
													{{ $solucion->estado->nombre_estado }}	
												</span>
												

											</td>
											<td class="text-center">
												@if( $solucion -> tipo_fuente == 1)
													<a href= "/detalle-despliegue-dialogo/{{ $solucion->id}}" title="Ver más" class="btn btn-primary" >
														Ver
													</a>
												@endif
												@if( $solucion -> tipo_fuente == 2)
													<a href= "/detalle-despliegue-dialogo/{{ $solucion->id}}" title="Ver más" class="btn btn-primary" >
														Ver
													</a>
												@endif


											</td>
							            </tr>
						            @endforeach
			     				</tbody>
							</table>
						@endif
						<!-- Fin Contenido -->
			</form>
            </div>
          </div>
				
				<br /><br /><hr>
				
				
	            <div class="row">
 					 
					<div class="col-md-12">
									
						@if(isset($resultados))
							<table id="data-table" class="table nowrap" width="100%">
								<thead>
									<th class="text-center" hidden="">id</th>
									<th class="text-center">PROPUESTA</th>
					                <th class="text-center">AMBITO</th>
					                <th class="text-center">RESPONSABLE</th>
					                <th class="text-center">ESTADO</th>

					                <th></th>
								</thead>
								<tbody>
						        	@foreach( $resultados as $solucion)
						        		<tr>
						        			
											<td hidden="">
						        				<input  type="checkbox" name="check[]" id="chk{{$solucion->id}}" checked value='{{$solucion->id}}'>
						        			</td>
											@if($solucion-> tipo_fuente == 1)
							                	<td class="text-left">
												<span class="total_propuestas_estilo_heading"><?php echo ucfirst(mb_strtolower($solucion->verbo_solucion)); ?></span><br>

									                <font><?php echo ucfirst(mb_strtolower($solucion->sujeto_solucion)) ?></font><br>
									                <font><?php echo ucfirst(mb_strtolower($solucion->complemento_solucion)) ?></font><br>
							                	</td>
							                @else
							                	@if($solucion-> tipo_fuente == 2)
							                		<td class="text-left"> 
													<span class="total_propuestas_estilo_heading"><?php echo ucfirst(mb_strtolower($solucion->verbo_solucion)); ?></span><br>

									                <font><?php echo ucfirst(mb_strtolower($solucion->sujeto_solucion)) ?></font><br>
									                <font><?php echo ucfirst(mb_strtolower($solucion->complemento_solucion)) ?></font><br>
							                		</td>
							                	@endif
							                @endif
							                <td class="text-left">{{ $solucion->ambit->nombre_ambit}}</td>
							                <td class="text-center">
							                	@if( count($solucion->actor_solucion) > 0 )
							                		@foreach( $solucion->actor_solucion as $actorSolucion)
							                			@if( $actorSolucion->tipo_actor == 1 )
							                				{{ $actorSolucion-> usuario-> name}}
							                			@endif
							                		@endforeach
							                	@endif

							                </td>

											<td class="text-left">
												<span class="label label-warning f-s-13">
													{{ $solucion->estado->nombre_estado }}	
												</span>
												

											</td>
											<td class="text-center">
												@if( $solucion -> tipo_fuente == 1)
													<a href= "/detalle-despliegue-dialogo/{{ $solucion->id}}" title="Ver más" class="btn btn-primary" >
														Ver
													</a>
												@endif
												@if( $solucion -> tipo_fuente == 2)
													<a href= "/detalle-despliegue-dialogo/{{ $solucion->id}}" title="Ver más" class="btn btn-primary" >
														Ver
													</a>
												@endif


											</td>
							            </tr>
						            @endforeach
			     				</tbody>
							</table>
						@endif

						
						<!-- Fin Contenido -->
					</div>
						<!-- end col-4 -->
				</div>
			
			
		</div>

	</div>

@endsection

@section('end_js')
  @parent

  <!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="{{ asset('plugins/DataTablesv2/datatables.js') }}"></script>
	<script src="{{ asset('js/table-manage-responsive.demo.js') }}"></script>
	<script src="{{ asset('plugins/scrollMonitor/scrollMonitor.js') }}"></script>
	<script src="{{ asset('js/custom-mipro.js" type="text/javascript') }}"></script>
	<script src="{{ asset('js/apps.js') }}"></script>
	<script src="{{ asset('js/dashboard.js') }}"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script language="javascript">

	$("#select_eje,#select_cadena").change(function() {
	  var eje = $("#select_eje").val();
	  var cadena = $("#select_cadena").val();
	  baseUrl = window.location.href.split("?")[0];
	  if (eje != 0) baseUrl += ( baseUrl.indexOf('?') >= 0 ? '&' : '?' ) + "eje=" + eje;
	  if (cadena != 0) baseUrl += ( baseUrl.indexOf('?') >= 0 ? '&' : '?' ) + "cadena=" + cadena;
	  window.location.href = baseUrl;
	});

	</script>

	<script>

		$(document).ready(function() {
			App.init();
			TablaCCPTHome.init();
		});

	</script>

	<script type="text/javascript">

		function ordenarSelect(id_componente)
	    {
	      var selectToSort = jQuery('#' + id_componente);
	      var optionActual = selectToSort.val();
	      selectToSort.html(selectToSort.children('option').sort(function (a, b) {
	        return a.text === b.text ? 0 : a.text < b.text ? -1 : 1;
	      })).val(optionActual);
	    }
	    $(document).ready(function () {
	      ordenarSelect('sectorSelect');
	    });

	</script>


@endsection
