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
	<div id="about" class="content work row-m-t-3" data-scrollview="true">
		<div class="container" data-animation="true" data-animation-type="fadeInDown">
	            <div class="row">
	            	
	            	<div class="col-md-4"> 
					<form role="form" method="GET" action="{{ route('nuevaBusqueda2') }}"> 
	            	<div class="wrapper">
                        <p><b>Filtros</b></p>
                        <ul align="right" class="nav nav-pills nav-stacked nav-sm m-b-0">
                            <li>
                            	<a href="javascript:;"><i class="fa fa-fw m-r-5 fa-circle text-inverse"></i> Tematica
                            		<select  class="form-group" id="TematicaSelect" name="TematicaSelect" style="width: 175px">
								 		<option value="0"></option> 
									</select>
                            	</a>

                            </li>
                            <li>
                            	<a href="javascript:;"><i class="fa fa-fw m-r-5 fa-circle text-primary"></i> Responsable
                            		<select class="form-group" id="responsableSelect" name="responsableSelect" style="width: 175px">
								 		<option value="">---Seleccione Responsable---</option> 
									</select>
                            	</a>
                            </li>
                            <li>
                            	<a href="javascript:;"><i class="fa fa-fw m-r-5 fa-circle text-success"></i> Corresponsable
                            		<select class="form-group" id="corresponsableSelect" name="corresponsableSelect" style="width: 175px">
								 		<option value="0"></option> 
									</select>
                            	</a>
                            </li>
                            <li >
                            	<?php $arraySectors[] = array(); ?>
                            	<a href="javascript:;"><i class="fa fa-fw m-r-5 fa-circle text-warning"></i> Sector
                            		@
                            	<select class="form-group" id="sectorSelect" name="sectorSelect" style="width: 175px">
								 		<option value="0"></option> 
								 		@foreach( $resultados as $solucion)
								 			@if( !in_array( $solucion->sector->id , $arraySectors) )
									 			<option value="{{ $solucion->sector->id}}">{{ $solucion->sector->nombre_sector }}</option>
									 			<?php array_push( $arraySectors, $solucion->sector->id ); ?>
									 		@endif
								 		@endforeach
									</select>	
                            	</a>
                            </li>
                        </ul>
                        <br>
				  					<button type="submit" class="btn btn-primary pull-right">Filtrar</button>
                    </div>
                    </form>
                    </div>
                    <div class="col-md-8">
                    	
	                    <div class="panel-body text-center">
	                        
	                        <form class="form-horizontal" role="form" method="GET" action="{{ route('nuevaBusqueda') }}">
	                            <div class="form-group">
	                                
	                                <div class="input-group custom-search-form">
	                                    <input type="text" class="form-control_2" placeholder="Busca todo sobre el diálogo con el sector productivo" name="parametro" required style="font-size: 16px" >
	                                    <span class="input-group-btn">
	                                        <button class="btn btn-buscar btn-lg" type="submit" height="50px">
	                                            <span class="glyphicon glyphicon-search"></span>
	                                        </button>
	                                    </span>

	                                </div>
	                                
	                            </div>
	                            
	                        </form>
							
	 
	                    </div>
	                    <div>
	                    	<button type="button" class="btn btn-white">Filtrar</button>
	                    </div>
							
	                    <div class="panel-body" >

	                    	<strong>"
							<a href="">	
								<b style="color: #00acac; font-size: 20px"></b>
							</a>
							"<span style="font-size: 20px;">Resultado de la Busqueda  </span>
						
							</strong>
							<a   class="btn btn-success pull-right" href="#"><i class="fa fa-2x fa-cloud-download"></i> Descargar</a>
							

	                    </div>
	                    <div class="row">
				
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats bg-blue">
						<div class="stats-icon"><i class="fa fa-chain-broken"></i></div>
						<div class="stats-info">
							<h4>BOUNCE RATE</h4>
							<p>20.44%</p>	
						</div>
						<div class="stats-link">
							<a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats bg-purple">
						<div class="stats-icon"><i class="fa fa-users"></i></div>
						<div class="stats-info">
							<h4>UNIQUE VISITORS</h4>
							<p>1,291,922</p>	
						</div>
						<div class="stats-link">
							<a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats bg-red">
						<div class="stats-icon"><i class="fa fa-clock-o"></i></div>
						<div class="stats-info">
							<h4>AVG TIME ON SITE</h4>
							<p>00:12:23</p>	
						</div>
						<div class="stats-link">
							<a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
			</div>
	                    <div class="panel-body" align="right">
	                    	<form action="">
	                    		<label for="">Ordenar: </label>
	                    		<select name="ordenar" id="selectOrdenar">
	                    			<option value="">---Ordenar por----</option>
	                    		</select>
	                    	</form>
	                    </div>
						
	                    <div class="panel-body" style="border-style: double; border-width: 1px;">
							<!-- titulo Propuesto -->
							<table id="data-table" class="table" width="100%">
								
								<thead>
					                <th></th>
								</thead>

									<tbody>
										@foreach( $resultados as $resultados)
										<tr>
										
											<td>
								@if($resultados->tipo_fuente==1) 			
							<br>
							<div class="text-justify" style="border-style: dotted; border-width: 1px;">
							<p>

								
								<strong><font face="verdana" size=2>{{$resultados->problema_solucion}}</font></strong><br>	
								
								<font face="verdana" size=1>{{$resultados->verbo_solucion." ".$resultados->sujeto_solucion." ".$resultados->complemento_solucion}}</font><br>

								<font face="verdana" size=1>Mesas de Competitividad</font><br>

								<font face="verdana" size=1>Nuemero de Acciones:</font><span class="badge badge-primary">5</span><br>
								<div class="progress progress-striped active" style="width:50%">
                                        <div class="progress-bar progress-bar-primary" style="width: 33%"></div>
                                        <div class="progress-bar progress-bar-info" style="width: 33%"></div>
                                  </div>	
							</p>
							<a   class="btn btn-primary pull-right" href="#">ver</a>
							<br><br>
							</div>
							<br>
							@endif
							<br>
							<div class="text-justify" style="border-style: dotted; border-width: 1px;">
							<p>

								
								<strong><font face="verdana" size=2>{{$resultados->problema_solucion}}</font></strong><br>	
								
								<font face="verdana" size=1>Consejo Consultivo</font><br>
								<font face="verdana" size=1>Numero de Acciones:</font><span class="badge badge-primary">5</span><br>
								<div class="progress progress-striped active" style="width:50%">
                                        <div class="progress-bar progress-bar-primary" style="width: 33%"></div>
                                        <div class="progress-bar progress-bar-info" style="width: 33%"></div>
                                  </div>	
							</p>
							<a   class="btn btn-primary pull-right" href="#">ver</a>
							<br><br>
							</div>
							<br>
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