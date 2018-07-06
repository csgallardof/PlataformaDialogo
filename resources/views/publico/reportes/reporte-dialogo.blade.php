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
	<div id="about" class="content work" data-scrollview="true">
		<div class="container" data-animation="true" data-animation-type="fadeInDown">


        <div class="toolbar title_ip_breadcrumb fit-m-b-10">
          <ol class="breadcrumb">

            <li class="home"><a href="{{ url('/') }}"><i class="fa fa-home fa-lg"></i><span></span></a></li>
            <li class="active"><a href="{{ url('/busquedaAvanzada') }}">Resultados de la B&uacute;squeda </a></li>

          </ol>
        </div><hr style="margin-top:-10px;">
		<div class="row">
			
			<div class="col-md-9">

				<div class="col-md-10 pull-left">

                    <div class="panel-body text-center p-r-25">

                            <div class="form-group">

                                <form class="form-horizontal" role="form" method="GET" action="{{ route('nuevaBusquedaDialogo') }}">

                                    <div class="input-group custom-search-form">

                                        <input type="text" class="form-control_2" placeholder="Busca todo sobre el diálogo con el sector productivo " name="parametro" value="" required style="font-size: 16px" >
                                        <span class="input-group-btn">
                                            <button class="btn btn-buscar btn-lg" style="background: #EF5D06; color: #fff; " type="submit" height="50px">
                                                <span class="glyphicon glyphicon-search"></span>
                                            </button>
                                        </span>

                                    </div>

                                </form>

                            </div>

                    </div>

			    </div>

          <div class="col-md-2">
            <div class="panel-body text-center">
              <a href="/descargar/Mesas" class="btn  btn-success btn-lg pull-right"><i class="fa fa-download"></i>&nbsp;Descargar</a>
            </div>
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
									<td><input type="checkbox" name="check[]" checked id="{{$excel->id}}" value='{{$excel->id}}'> </td>
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
										<a   class="btn btn-primary pull-right m-b-30 m-l-30" href="/detalle-despliegue-dialogo/{{ $resultado->id}}">ver</a>

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
					
					{!! $resultados->setPath($urlResultados)!!}					
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
