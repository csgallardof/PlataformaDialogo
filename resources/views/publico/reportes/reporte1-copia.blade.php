@extends('layouts.main')

@section('title', 'Reporte')

@section('start_css')
  @parent
  	<link href="{{ asset('plugins/DataTablesv2/datatables.css') }}" rel="stylesheet" />
	<link href="{{ asset('css/style-after.css') }}" rel="stylesheet" />
	
@endsection

@section('contenido')

<br>
<br><br><br><br><br><br>
	<!-- begin row -->
	<div id="about" class="content row-m-t-2" data-scrollview="true">
		<div class="container" data-animation="true" data-animation-type="fadeInDown">
					<div class="row">

							<!-- begin col-4 -->
						<div class="col-md-12">
							<!-- Inicio Contenido -->
							<h1>REPORTE </h1>
							<hr class="m-t-5"/>

							<div class="row">
								<form class="form-inline" action = "{{ url('reporte') }}" method="POST" onsubmit="return botonesRequeridos()">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<div class="col-md-2">
									    <label class="mr-sm-2" for="tipoFuente">Fuente</label><br>
										<select name="tipo_fuente" class="custom-select mb-2 mr-sm-2 mb-sm-0" id="tipoFuente" required="true">
											@if( !isset($paramFuente))
									    		<option value="" selected>Seleccione una fuente...</option>
									    	@else
									    		<option value="">Seleccione una fuente...</option>
									    	@endif
									    	@if( isset($paramFuente) && $paramFuente == 1)
									    		<option value="1" selected>Mesas Competitivas</option>
									    	@else
									    		<option value="1">Mesas Competitivas</option>
									    	@endif
									    	@if( isset($paramFuente) && $paramFuente == 2)
									    		<option value="2" selected>Consejo Consultivo</option>
									    	@else
									    		<option value="2">Consejo Consultivo</option>
									    	@endif

									    </select>
									</div>

								  	<div class="col-md-3" >
									    <label class="mr-sm-2" for="selectSipoc">Eslab&oacute;n de la cadena Productiva</label>
										<select name="sipoc" class="custom-select mb-2 mr-sm-2 mb-sm-0" id="selectSipoc">
											<option value="0" selected>Seleccione un eslab&oacute;n...</option>
									     	@foreach($sipocs as $sipoc)

													@if(isset($paramSipoc))
														@if($sipoc->id == $paramSipoc->id)
															<option value="{{ $sipoc->id }}" selected > {{ $sipoc->nombre_sipoc }} </option>
														@else
															<option value="{{ $sipoc->id }}" > {{ $sipoc->nombre_sipoc }}</option>
														@endif	
													@else
														<option value="{{ $sipoc->id }}" > {{ $sipoc->nombre_sipoc }}</option>
													@endif	

											@endforeach
									    </select>
									</div>

									<div class="col-md-4">
										<label class="mr-sm-2" for="selectAmbit">&Aacute;mbito</label><br>
										<select name="ambito" class="custom-select mb-2 mr-sm-2 mb-sm-0" id="selectAmbit">
									    	<option value="0" selected>Seleccione un &aacute;mbito...</option>
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
									
									<div class="col-md-2">
								  		<button type="submit" class="btn btn-primary pull-right">Filtrar</button>
								  	</div>
								</form>
							</div>

							<hr>

							@if(isset($paramFuente))
								<i>{{ "Se muestra los resultados para: "}}</i><br>
								<label class='text-success f-s-14'>
										Fuente: 
								</label> 
								@if($paramFuente == 1)
									{{ "Mesas Competitivas" }}
								@endif
								@if($paramFuente == 2)
									{{ "Consejo Consultivo" }}
								@endif
							@endif

							@if( isset($paramSipoc) && isset($paramAmbit) )
								@if( $paramSipoc-> id > 0  && $paramAmbit->id > 0)
									<label class='text-success f-s-14'>
										| Eslab&oacute;n de la cadena: 
									</label> 
									{{ $paramSipoc->nombre_sipoc}}
									<label class='text-success f-s-14'>
										| &Aacute;mbito:  
									</label>
							    	{{ $paramAmbit->nombre_ambit  }}
								@endif
								
							@endif

							@if( isset($paramSipoc) && !isset($paramAmbit)  )
								@if( $paramSipoc-> id > 0 )
									<label class='text-success f-s-14'>
										| Eslab&oacute;n de la cadena: 
									</label>
									{{ $paramSipoc->nombre_sipoc}} 
								@endif
								
							@endif

							@if( isset($paramAmbit) && !isset($paramSipoc) )
								
									@if( $paramAmbit-> id > 0)
									<label class='text-success f-s-14'>
										| &Aacute;mbito:  
									</label>
									{{ $paramAmbit->nombre_ambit  }}
									@endif
								
							@endif
							<hr>

							@if(isset($paramFuente) && $paramFuente== 1)
								@if(isset($soluciones))
									<table id="data-table" class="table nowrap" width="100%">
											<thead>
												<th>#</th>
								                <th class="text-center">&Aacute;MBITO</th>
								                <th class="text-center">ESLAB&Oacute;N DE LA CADENA PRODUCTIVA</th>
								                <th class="text-center">GRUPO</th>
								                <th class="text-center">PROBLEM&Aacute;TICA</th>
								                <th class="text-center">PROPUESTA</th>
								                <th class="text-center">INSTRUMENTOS NECESARIOS</th>
								                
								                <th class="text-center">RESPONSABLE DE EJECUCI&Oacute;N</th>
								                <th class="text-center">CO-RESPONSABLES DE EJECUCI&Oacute;N</th>
								                <!--  <th>Acci&oacute;n</th>  -->
											</thead>
											<tbody>				        	
									        	@foreach( $soluciones as $solucion)
													<tr>
										                <td class="text-center">{{ $solucion->id }}</td>
										                <td class="text-center">{{ $solucion->ambit->nombre_ambit }}</td>
										                <td class="text-center">{{ $solucion->sipoc->nombre_sipoc }}</td>
										                <td class="text-center">{{ $solucion->sector->nombre_sector}}</td>

										                <td class="text-center">{{ $solucion->problema_solucion }}</td>
										                <td class="text-center">{{ $solucion->verbo_solucion." ".$solucion->sujeto_solucion."  ".$solucion->complemento_solucion }}</td>
										                <td class="text-center">{{ $solucion->instrumento->
										                nombre_instrumento }}</td>
														<td class="text-center">{{ $solucion->responsable_solucion }}</td>
														<td class="text-center">{{ $solucion->corresponsable_solucion }}</td>
										            </tr>
									            @endforeach			   
						     				</tbody>
									</table>
								@endif
							@endif

							@if(isset($paramFuente) && $paramFuente== 2)
								@if(isset($soluciones))
									<table id="data-table" class="table nowrap" width="100%">
										<thead>
								            <tr>
								                <th class="text-center">MESA</th>
								                <th class="text-center">PROPUESTA ORIGINAL</th>
								                <th class="text-center">FOMENTO DE LA PRODUCCI&Oacute;N NACIONAL</th>
								                <th class="text-center">&Aacute;MBITO</th>
								                <th class="text-center">SECTOR</th>
								                <th class="text-center">RESPONSABLE</th>
								                <th class="text-center">CORRESPONSABLES</th>
								                <th class="text-center">ESLAB&Oacute;N DE LA CADENA</th>
								                <th class="text-center">PROPUESTAS UNIFICADAS</th>
								            </tr>
								        </thead>
								        <tbody>
								        	@foreach($soluciones as $solucion)
											<tr>
												<td class="text-center">{{ $solucion->mesa->nombre_mesa}}</td>
								                <td class="text-center">{{ $solucion->solucion_ccpt}}</td>
								                <td class="text-center">{{ $solucion->thematic->nombre_thematic}}</td>
								                <td class="text-center">{{ $solucion->ambit->nombre_ambit}}</td>
								                <td class="text-center">{{ $solucion->sector->nombre_sector }}</td>
								                <td class="text-center">{{ $solucion->responsable_solucion }}</td>
								                <td class="text-center">{{ $solucion->corresponsable_solucion }}</td>
								                <td class="text-center">{{ $solucion->sipoc->nombre_sipoc }}</td>
												<td class="text-center">{{ $solucion->pajustada->nombre_pajustada }}</td>
								            </tr>
								            @endforeach		            
								        </tbody>
							    	</table>
			    				@endif
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


@endsection