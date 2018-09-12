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
							<h4 class="modal-title" style="display: inline;">Vocaciones Provinciales</h4>
              <a class="p-l-20" target="_blank" href="{{ asset('imagenes/vocaciones_productivas_ecuador/vocaciones_pdf/vocaciones_productivas_todas.pdf') }}"><i class="fa fa-2x fa-file-pdf-o"></i>&nbsp;Descargar Archivo Consolidado</a>
					</div>

					<!-- begin row -->
					<div class="row">
							<!-- begin col-4 -->
						<div class="col-md-12">
							
								<div class="col-md-12">
				                	<ul class="nav nav-tabs">
										<li class="active"><a href="#default-tab-1" data-toggle="tab">COSTA</a></li>
										<li class=""><a href="#default-tab-2" data-toggle="tab">Sierra</a></li>
										<li class=""><a href="#default-tab-3" data-toggle="tab">Oriente</a></li>
										<li class=""><a href="#default-tab-4" data-toggle="tab">Insular</a></li>
									</ul>
									<div class="col-md-12">
										<div class="tab-content">
											<!-- COSTA-->
											<div class="tab-pane fade active in " id="default-tab-1">
												<div class="col-md-12">
													<ul class="nav nav-tabs">
														<?php $count = 1;?>
														@foreach($provincias as $provincia)
															@if( $provincia-> region == 1)
																@if( $count == 1)
																	<li class="active"><a href="#tab-imagen" onclick="llenarTab({{ $provincia->id }},'{{ $provincia-> nombre_provincia }}' )" data-toggle="tab">{{ $provincia-> nombre_provincia }}</a></li>
																@else
																	<li class=""><a href="#tab-imagen" onclick="llenarTab({{ $provincia->id }},'{{ $provincia-> nombre_provincia }}')" data-toggle="tab">{{ $provincia-> nombre_provincia }}</a></li>
																@endif
																<?php $count++; ?>
															@endif
														@endforeach
													</ul>	
												</div>
											</div>
										
											<!--FIN COSTA-->
											<!-- SIERRA-->
											<div class="tab-pane fade" id="default-tab-2">
												<div class="col-md-12">
													<ul class="nav nav-tabs">
														<?php $count = 1;?>
														@foreach($provincias as $provincia)
															@if( $provincia-> region == 2)
																@if( $count == 1)
																	<li class="active"><a href="#tab-imagen" onclick="llenarTab({{ $provincia->id }},'{{ $provincia-> nombre_provincia }}' )" data-toggle="tab">{{ $provincia-> nombre_provincia }}</a></li>
																@else
																	<li class=""><a href="#tab-imagen" onclick="llenarTab({{ $provincia->id }},'{{ $provincia-> nombre_provincia }}')" data-toggle="tab">{{ $provincia-> nombre_provincia }}</a></li>
																@endif
																<?php $count++; ?>
															@endif
														@endforeach
													</ul>
												</div>
											</div>
											<!-- FIN SIERRA-->

											<!-- ORIENTE-->
											<div class="tab-pane fade" id="default-tab-3">
												<div class="col-md-12">
													<ul class="nav nav-tabs">
														<?php $count = 1;?>
														@foreach($provincias as $provincia)
															@if( $provincia-> region == 3)
																@if( $count == 1)
																	<li class="active"><a href="#tab-imagen" onclick="llenarTab({{ $provincia->id }},'{{ $provincia-> nombre_provincia }}' )" data-toggle="tab">{{ $provincia-> nombre_provincia }}</a></li>
																@else
																	<li class=""><a href="#tab-imagen" onclick="llenarTab({{ $provincia->id }},'{{ $provincia-> nombre_provincia }}')" data-toggle="tab">{{ $provincia-> nombre_provincia }}</a></li>
																@endif
																<?php $count++; ?>
															@endif
														@endforeach
													</ul>
												</div>
											</div>
											<!--FIN ORIENTE-->


											<!-- INSULAR-->
											<div class="tab-pane fade" id="default-tab-4">
												<div class="col-md-12">
													<ul class="nav nav-tabs">
														<?php $count = 1;?>
														@foreach($provincias as $provincia)
															@if( $provincia-> region == 4)
																@if( $count == 1)
																	<li class="active"><a href="#tab-imagen" onclick="llenarTab({{ $provincia->id }},'{{ $provincia-> nombre_provincia }}' )" data-toggle="tab">{{ $provincia-> nombre_provincia }}</a></li>
																@else
																	<li class=""><a href="#tab-imagen" onclick="llenarTab({{ $provincia->id }},'{{ $provincia-> nombre_provincia }}')" data-toggle="tab">{{ $provincia-> nombre_provincia }}</a></li>
																@endif
																<?php $count++; ?>
															@endif
														@endforeach
													</ul>	
												</div>
												
                            				</div>
                            			
										</div>
									</div>
									<br><br><br><br>



									{{-- IMAGEN --}}
									<div class="tab-pane active in fade ol-md-10 col-md-offset-1" id="tab-imagen">
                            			<div class="m-t-10 row">
                            				<div class="m-t-15 col-md-6" id="nombreProvincia">
                                				<i class="fa fa-2x fa-map-marker"><strong class="f-s-19">&nbsp;&nbsp;El Oro</strong></i>
                              				</div>
                              			<div class="col-md-6">
                                			<div class="pull-right">

                                				<a id="dw_pdf" target="_blank" href="{{ asset('imagenes/vocaciones_productivas_ecuador/vocaciones_pdf/pdf_por_provincia/vocaciones_productivas_eloro.pdf') }}"><i class="fa fa-3x fa-file-pdf-o"></i>&nbsp;Descargar Archivo de la Provincia</a></div>
                              				</div>
                            			</div>
                            			<hr />
                            			<!-- Fin Header Provincia -->
									    <div class="row fit-m-t-4">
									    	<div class="col-md-12">
									    		<img id="imagenvp" class="img-responsive center-block"  src="{{ asset('imagenes/vocaciones_productivas_ecuador/vocaciones_productivas_eloro.jpg') }}" alt="El Oro">
									    	</div>
									    </div>
									</div>
									{{-- FIN IMAGEN --}}





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

  @section('init_scripts')

    <!-- Cargar datos provincias DOM -->
    <script type="text/javascript">
        
        function llenarTab(num, nombreProvincia){
        	valor = null;
            if(num == 1){
                valor =  'azuay';
            }
            if(num == 2){
                valor =  'bolivar';
            }
            if(num == 3){
                valor =  'canar';
            }
            if(num == 4){
                valor =  'carchi';
            }
            if(num == 5){
                valor =  'chimborazo';
            }
            if(num == 6){
                valor =  'cotopaxi';
            }
            if(num == 7){
                valor =  'eloro';
            }
            if(num == 8){
                valor =  'esmeraldas';
            }
            if(num == 9){
                valor =  'galapagos';
            }
            if(num == 10){
                valor =  'guayas';
            }
            if(num == 11){
                valor =  'imbabura';
            }
            if(num == 12){
                valor =  'loja';
            }
            if(num == 13){
                valor =  'losrios';
            }
            if(num == 14){
                valor =  'manabi';
            }
            if(num == 15){
                valor =  'moronasantiago';
            }
            if(num == 16){
                valor =  'napo';
            }
            if(num == 17){
                valor =  'orellana';
            }
            if(num == 18){
                valor =  'pastaza';
            }
            if(num == 19){
                valor =  'pichincha';
            }
            if(num == 20){
                valor =  'santaelena';
            }
            if(num == 21){
                valor =  'santodomingo';
            }
            if(num == 22){
                valor =  'sucumbios';
            }
            if(num == 23){
                valor =  'tungurahua';
            }
            if(num == 24){
                valor =  'zamorachinchipe';
            }
            $('#imagenvp').prop("src", "imagenes/vocaciones_productivas_ecuador/vp_" + valor + ".png");
        	$("#dw_pdf").attr("href", "imagenes/vocaciones_productivas_ecuador/vocaciones_pdf/pdf_por_provincia/vocaciones_productivas_" + valor + ".pdf");
        	$("#nombreProvincia").html("<i class='fa fa-2x fa-map-marker'><strong class='f-s-19'>&nbsp;&nbsp;"+ nombreProvincia +"</strong></i>");
        } 
    </script>


@endsection
