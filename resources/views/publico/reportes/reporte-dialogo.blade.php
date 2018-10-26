@extends('layouts.main')

@section('title', 'Busqueda - Plataforma de Diálogo')

@section('start_css')
  @parent
  	<link href="{{ asset('plugins/DataTablesv2/datatables.css') }}" rel="stylesheet" />
	<link href="{{ asset('css/style-after.css') }}" rel="stylesheet" />


@endsection

@section('contenido')

<br><br><br><br>
	<!-- begin row -->
	<div class="row-m-t-3 p-t-40" data-scrollview="true">
		<div class="container-fluid" data-animation="true" data-animation-type="fadeInDown">


        <div class="toolbar title_ip_breadcrumb fit-m-b-10">
          <ol class="breadcrumb">

            <li class="home"><a href="{{ url('/') }}" title="Busqueda dialogo"><span style="text-indent: -9999px; display: block; float: left;">Búsqueda</span><i class="fa fa-home fa-lg"></i><span></span></a></li>
            <li class="active"><a href="#">Resultados de la B&uacute;squeda </a></li>

          </ol>
        </div>
		<div class="row p-20">
			<div class="col-md-3" style="border: #D7DBDD 1px solid; padding: 1%">

				<form role="form" method="GET"    action="/busquedaAvanzadaDialogoFiltro/"  >
				{{ csrf_field() }}
				<input type="hidden" name="selectBusqueda" id="selectBusqueda" value="si"/>
				<div class="toolbar title_ip_breadcrumb fit-m-b-10">

		          <ol class="breadcrumb">

		            <li class="home">Filtros</li>
		            <li class="active"><button type="submit" class="btn btn-primary m-l-20 pull-rigth">Aplicar Filtros</button></li>

		          </ol>
		        </div>
					<div class="form-group">
						<?php // $arraySectors[] = array(); ?>

						 		

                				<?php $arraySectors[] = array(); ?>

						 		<!--<div >

					

							    <label for="sectorSelect">Fuentes</label>
								 	<select class="form-group form-control" id="sectorSelect" name="sectorSelect" >
								 		<option value="0">Seleccionar </option>
								 		@if(!isset($institucion) and  empty($data['institucion']))
									 		@foreach($resultados as $fuentes)
									 			<option value="{{ $fuentes->nombre_institucion}}">{{ $fuentes->nombre_institucion}}</option>
									 			
									 		@endforeach
								 		@else
									 		@foreach( $institucion as $fuentes)
									 			<option value="{{ $fuentes->nombre_institucion}}">{{ $fuentes->nombre_institucion}}</option>
									 		@endforeach

								 		@endif	
								 	</select>
                				</div>-->
                				


                				<div >

							    <label for="palabra_clave">Palabras Clave</label>
								  <input type="text" name="palabra_clave" id="palabra_clave" class="form-group form-control">
                				</div>


                				<div>

             					  <label for="provincias">Provincias</label>
								 	<select class="form-group form-control" id="provincias" name="provincias" >
								 		<option value="0">Seleccionar </option>
								 		@foreach( $provincias as $prov)
								 			<option value="{{ $prov->id}}">{{ $prov->nombre_provincia}}</option>
								 			
								 		@endforeach
								 	</select>
                				</div>

						 		
						 		
                				
					</div>
				</form>
			</div>
			
			<div class="col-md-9">

				<div class="col-md-10 pull-left">

                    <div class="panel-body text-center p-r-25">

                            <div class="form-group">

                                <form class="form-horizontal" role="form" method="GET" action="{{ route('nuevaBusquedaDialogo') }}">

                                    <div class="input-group custom-search-form">

                                       <!--  <input type="text" class="form-control_2" placeholder="Busca todo sobre el diálogo con el sector productivo " name="parametro" value="" required style="font-size: 16px" > -->
                                       <label for="buscar_general" style="display: none;">Ingrese texto de busqueda</label>
                                       <input type="hidden" name="selectBusqueda" value="si">
                                       
                                       <input id="buscar_general" type="text" class="form-control input-lg" name="parametro" placeholder="Buscar información sobre propuestas y pedidos del diálogo nacional" required>
                                        <span class="input-group-btn">
                                           	<button id="btn_buscar" class="btn btn-default" type="submit">
                                            	Buscar
                                          	</button>
                                        </span>

                                    </div>

                                </form>

                            </div>

                    </div>

			    </div>

          <div class="col-md-2">
            
          </div>

					<div class="col-md-12">
					<span class="title_ip_h1">

						<?php $total = 0;

							foreach ($resultadosreporte as $solucion){
								$total=$total+1;
							}
						?>
						{{$total}}
					Resultados de la B&uacute;squeda</span>



					<!-- inicio cuadrados -->
					<br>

					<div class="col-md-12">
						<br>
						<!-- begin col-3 -->
				<div class="col-md-4 col-sm-6">
					<div class="widget widget-stats" style="background-color:#214974; color:white;">
						<div class="stats-info">
						<?php
	    					$totalMesasCom=0;
	            			$totalCCTP=0;
	            			$estadoAsignado1=0;
				            $estadoDesarrollo1=0;
				            $estadoAsignado2=0;
				            $estadoDesarrollo2=0;
	                     foreach($resultados as $solucion ) {

	                        if($solucion->tipo_fuente==1){
	                        $totalMesasCom=$totalMesasCom+1;
	                        if($solucion->estado_id==2){
	                    	$estadoAsignado1=$estadoAsignado1+1;
	                    	}elseif($solucion->estado_id==3){
	                    	$estadoDesarrollo1=$estadoDesarrollo1+1;
	                    	}
	                    	}
	                        else {
	                        $totalCCTP=$totalCCTP+1;
	                        if($solucion->estado_id==2){
	                    	$estadoAsignado2=$estadoAsignado2+1;
	                    	}elseif($solucion->estado_id==3){
	                    	$estadoDesarrollo2=$estadoDesarrollo2+1;
	                    	}
	                        }
	                    }
	                    $totalPropuesta=$totalMesasCom+$totalCCTP;
	                    $totalEstadoAsignado=$estadoAsignado1+$estadoAsignado2;
	                    $totalEstadoDesarrollo=$estadoDesarrollo1+$estadoDesarrollo2;
	    				?>
              <b class="f-s-19">{{$totalPropuesta}}</b><b class="f-s-15">&nbsp;&nbsp;Propuestas Registradas</b>
						</div>

					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-md-4 col-sm-6">
					<div class="widget widget-stats" style="background-color:#214974; color:white;">
						<div class="stats-info">
              <b class="f-s-19">{{$totalEstadoAsignado}}</b><b class="f-s-15">&nbsp;&nbsp;Propuestas Asignadas</b>
						</div>

					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-md-4 col-sm-6">
					<div class="widget widget-stats" style="background-color:#214974; color:white;">
						<div class="stats-info">
							<b class="f-s-19">{{$totalEstadoDesarrollo}}</b><b class="f-s-15">&nbsp;&nbsp;Propuestas en Desarrollo</b>
						</div>

					</div>
				</div>
				<!-- end col-3 -->
					</div>
					<!-- Final cuadrados -->

					<div class="col-md-12">
						<form target="_blank" method="POST" action="/propuesta-dialogo-nacional/descargar-excel" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="form-group">
                                    <div class="col-md-2 ">
                                        
                                        <button type="submit"  class="btn btn-primary">Descargar Excel</button>

                                    </div>
                                      
                                </div>
							<table hidden>
								<thead>
									<th class="text-left f-s-18">Seleccionar</th>
									<th class="text-left f-s-18">id</th>
								</thead>
								<tbody>
									@foreach( $resultadosreporte as $excel)
									<tr>
									<td>
                                    <label for="{{$excel->id}}">Variable oculta del sistema para descargar el archivo</label>
									<input type="checkbox" name="check[]" checked id="{{$excel->id}}" value='{{$excel->id}}'> </td>
									<td>{{$excel->id}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</form>
						<form target="_blank" method="POST" action="/propuesta-dialogo-nacional/descargar-pdf/1" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="form-group">
                                    <div class="col-md-3 ">
                                        
                                        <button type="submit"  class="btn btn-success">Descargar PDF</button>

                                    </div>
                                      
                                </div>
							<table hidden>
								<thead>
									<th class="text-left f-s-18">Seleccionar</th>
									<th class="text-left f-s-18">id</th>
								</thead>
								<tbody>
									@foreach( $resultadosreporte as $excel)
									<tr>
									<td><input type="checkbox" name="check[]" checked id="{{$excel->id}}" value='{{$excel->id}}'> </td>
									<td>{{$excel->id}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</form>
						
					</div>

				<!-- Inicio col-8 tabla -->
				<div class="col-md-12">

				@if(isset($resultados))
                   <?php   //dd($resultados); ?>
				<!-- Inicio tabla paginado -->
					<table id="" class="table nowrap" width="100%">
						<thead>
							<th class="text-left f-s-18">Propuestas Encontradas</th>
						</thead>
						<tbody>
							@foreach( $resultados as $resultado)
							<tr>
								<td class="text-left p-t-15">
									
									<div class="text-justify">
										 <a   class="btn btn-primary pull-right m-b-30 m-l-30"  href="{{ url('/detalle-despliegue-dialogo/'.$resultado->id) }}">ver</a>

										<p class="total_propuestas_estilo_1">
		  								<span class="total_propuestas_estilo_heading"><?php echo ucfirst(mb_strtolower($resultado->problema_solucion)); ?></span><br>

		  								<font><?php echo ucfirst(mb_strtolower($resultado->propuesta_solucion)) ?></font><br>

		  								<b><font >Fuente: </font></b><?php echo ucfirst(mb_strtolower($resultado->nombre)) ?><br>

		  								<font ><strong>Responsable: </strong>{{$resultado->responsable_solucion}}</font><br>

	                                 </div>
	                                 <div class="progress progress-striped active" style="width:50%">
	                                 	@if($resultado->estado_id>=1)
                                        <div class="progress-bar progress-bar-primary" style="width: 33%">En Análisis</div>
                                        @endif
                                        @if($resultado->estado_id>=3)
                                        <div class="progress-bar progress-bar-info" style="width: 33%">En Desarrollo</div>
                                        @endif
                                        @if($resultado->estado_id==4)
                                        <div class="progress-bar progress-bar-success" style="width: 34%">Finalizado</div>
                                        @endif
                                        

                                  	</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					
					
						@endif
                      
						<!-- Fin Contenido -->
					</div>
					<!-- end col-8 tabla -->

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
