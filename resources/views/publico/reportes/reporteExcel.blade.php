@extends('layouts.main')

@section('title', 'Reporte')

@section('start_css')
  @parent
  	<link href="{{ asset('plugins/DataTablesv2/datatables.css') }}" rel="stylesheet" />
	<link href="{{ asset('css/style-after.css') }}" rel="stylesheet" />
	
@endsection

@section('contenido')

<br>
<br><br><br>
	<!-- begin row -->
	<div id="about" class="content work row-m-t-3" data-scrollview="true">
		<div class="container" data-animation="true" data-animation-type="fadeInDown">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 row-m-t-minus-25" >
	                    <div class="panel-body text-center">
	                        
	                        <form class="form-horizontal" role="form" method="GET" action="{{ route('nuevaBusqueda') }}">
	                            <div class="form-group">
	                                
	                                <div class="input-group custom-search-form">
	                                    <input type="text" class="form-control_2" placeholder="Busca todo sobre el diálogo con el sector productivo" name="parametro" required style="font-size: 16px" >
	                                    <span class="input-group-btn">
	                                        <button class="btn btn-buscar btn-lg" type="submit" height="50px">
	                                            <span class="glyphicon glyphicon-search">&nbsp;BUSCAR3</span>
	                                        </button>
	                                    </span>

	                                </div>
	                                
	                            </div>
	                        </form>

	 
	                    </div>
	                </div>
	            </div>


	            <div class="row">
	            	
	            	<b style="font-size: 20px; padding-left: 15px">FILTROS</b>
					 
					<form role="form" method="GET" action="{{ route('nuevaBusqueda') }}">
					 	<input type="hidden" name="parametro" value="{{ Request::get('parametro')}}">
					 	<div class="form-group">
						 	<div class="form-check form-check-inline">
							    <div class="col-md-5">
							    	<label>Fuente</label><br>
							    	<div class="col-md-6">
							    		@if( isset($filtros["mesas"]) && $filtros["mesas"] == true )
							    			<input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="checkbox1" value="true" checked="true"> Mesas Competititvas
							    		@else
							    			<input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="checkbox1" value="true"> Mesas de Competitividad
							    		@endif
							    		<br>
							    		<a href="/descargar/Mesas">
							    			<i class="fa fa-download"></i>
							    			<span>Descargar</span>
							    		</a>
							    	</div>
							    	<div class="col-md-6">
							    		@if( isset($filtros["consejo"]) && $filtros["consejo"] == true )
							    			<input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="checkbox2" value="true" checked="true"> Consejo Consultivo
							    		@else
							    			<input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="checkbox2" value="true"> Consejo Consultivo
							    		@endif
							    		<br>
							    		<a href="/descargar/Consejo">
							    			<i class="fa fa-download"></i>
							    			<span>Descargar</span>
							    		</a>
							    	</div>
							    </div>

							    <?php $arraySectors[] = array(); ?>

							    <div class="col-md-2">
							    	<label for="sectorSelect">Sector</label><br>
								 	<select class="form-group" id="sectorSelect" name="sectorSelect" style="width: 175px">
								 		<option value="0"></option>
								 		@foreach( $resultados as $solucion)
								 			@if( !in_array( $solucion->sector->id , $arraySectors) )
									 			<option value="{{ $solucion->sector->id}}">{{ $solucion->sector->nombre_sector }}</option>
									 			<?php array_push( $arraySectors, $solucion->sector->id ); ?>
									 		@endif
								 		@endforeach
								 	</select>
							    </div>

							    <?php $arrayResponsables[] = array(); ?>

							    <div class="col-md-2">
							    	<label for="sectorSelect">Responsable</label><br>
								 	<select class="form-group" id="responsableSelect" name="responsableSelect" style="width: 175px">
								 		<option value="0"></option>
								 		@foreach( $resultados as $solucion)
								 			@if( count($solucion->actor_solucion) > 0 )
						                		@foreach( $solucion->actor_solucion as $actorSolucion)
						                			@if( $actorSolucion->tipo_actor == 1 )
						                				@if( !in_array( $actorSolucion-> usuario-> id , $arrayResponsables) )
						                					<option value="{{ $actorSolucion-> usuario-> id}}">{{ $actorSolucion-> usuario-> name}}</option>
						                					<?php array_push( $arrayResponsables, $actorSolucion->usuario->id ); ?>
						                				@endif
						                			@endif
						                		@endforeach
							                @endif
							            @endforeach

								 	</select>
							    </div>
						
							    <?php $arrayCorresponsables[] = array(); ?>

							    <!-- <div class="col-md-2">
							    	<label for="sectorSelect">Corresponsable</label><br>
								 	<select class="form-group" id="corresponsableSelect" name="corresponsableSelect" style="width: 175px">
								 		<option value="0"></option>
								 		@foreach( $resultados as $solucion)
								 			@if( count($solucion->actor_solucion) > 0 )
				                	    		@foreach( $solucion->actor_solucion as $actorSolucion)
						                			@if( $actorSolucion->tipo_actor == 2 )
						                				@if( !in_array( $actorSolucion-> usuario-> id , $arrayCorresponsables) )
						                					<option value="{{ $actorSolucion-> usuario-> id}}">{{ $actorSolucion-> usuario-> name}}</option>
						                					<?php array_push( $arrayCorresponsables, $actorSolucion->usuario->id ); ?>
						                				@endif
						                			@endif
						                		@endforeach
						                	@endif
							            @endforeach
								 		
										
								 	</select>
							    </div>
 -->
							    <div class="col-md-1">
							    	<br>
				  					<button type="submit" class="btn btn-primary pull-right">Filtrar</button>
				  				</div>

							</div>
						</div>
						
					</form>
				</div>
				<hr>

				<br> 
					<span style="font-size: 22px;">Resultado de la B&uacute;squeda / </span>
						@if(isset($parametro))
							Se muestran los resultados para "
							<a href="/busqueda?parametro={{ Request::get('parametro') }}">	
								<b style="color: #00acac; font-size: 16px">{{ $parametro }}</b>
							</a>
							"
						@endif
						
						
				<hr>


	            <div class="row">
					
					<div class="col-md-12">

						@if(isset($resultados))
							<table id="data-table" class="table nowrap" width="100%">
								<thead>
									<th>#</th>
					                <th class="text-center">PROPUESTA</th>
					                <th class="text-center">SECTOR</th>
					                <th class="text-center">RESPONSABLE</th>
					                <th class="text-center">CORRESPONSABLE</th>
					                <th></th>
								</thead>
								<tbody>				        	
						        	@foreach( $resultados as $solucion)
						        		<tr>
							                <td class="text-center">{{ $solucion->id }}</td>
											@if($solucion-> tipo_fuente == 1)							                
							                	<td class="text-center">{{ $solucion->verbo_solucion." ".$solucion->sujeto_solucion."  ".$solucion->complemento_solucion }}</td>
							                @else
							                	@if($solucion-> tipo_fuente == 2)							                
							                		<td class="text-center">{{ $solucion->solucion_ccpt }}</td>
							                	@endif
							                @endif
							                <td class="text-center">{{ $solucion->sector->nombre_sector}}</td>
							                <td class="text-center">
							                	@if( count($solucion->actor_solucion) > 0 )
							                		@foreach( $solucion->actor_solucion as $actorSolucion)
							                			@if( $actorSolucion->tipo_actor == 1 )
							                				{{ $actorSolucion-> usuario-> name}}
							                			@endif
							                		@endforeach
							                	@endif
							                	
							                </td>
							                <td class="text-center">
							                	@if( count($solucion->actor_solucion) > 0 )
							                		<ul>
								                		@foreach( $solucion->actor_solucion as $actorSolucion)
								                			@if( $actorSolucion->tipo_actor == 2 )
								                				<li>{{ $actorSolucion-> usuario-> name}}</li>
								                			@endif
								                		@endforeach
							                		</ul>
							                	@endif
							                	
							                </td>
											<td class="text-center">
												@if( $solucion -> tipo_fuente == 1)
													<a href= "/detalle-despliegue/{{ $solucion->id}}" title="Ver más" class="btn btn-primary" >
														Ver
													</a>
												@endif
												@if( $solucion -> tipo_fuente == 2)
													<a href= "/detalle-ccpt/{{ $solucion->pajustada_id }}/{{ $solucion->sector_id }}/{{ $solucion->ambit_id }}/{{$solucion->sipoc_id}}" title="Requerimiento" class="btn btn-primary" >
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
			TableManageResponsive.init();
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