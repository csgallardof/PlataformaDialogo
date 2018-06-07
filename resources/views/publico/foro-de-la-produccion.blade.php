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
							<li><a href="dashboard.php">Inicio</a></li>
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
			<div id="contratos" class="content row-m-t-2" data-scrollview="true">

					<!-- begin container -->
				<div class="container" data-animation="true" data-animation-type="fadeInDown">

					<!-- begin row -->
					
							<!-- begin col-4 -->
						<!-- ini kir inversionista  -->

             

				<div id="" class="modal-header">
					<h4 class="modal-title "><strong>1° Foro de la Producción e  <span style="color: #F26F21">Impulso a la Innovación y Competitividad</span></strong></h4>
				</div>

            

           

							<!-- end col-4 -->
					

				</div>

			</div>
			<!-- end #about -->


      <div id="incentivos" class="content row-m-t-2" data-scrollview="true">
					<!-- begin container -->
				<div class="container" data-animation="true" data-animation-type="fadeInDown">

					<!-- begin row -->
					<div class="row">
							<!-- begin col-4 -->
						<!-- ini kir inversionista  -->

						<div class="modal-header">
			
            <div class="col-md-6">
                <img src="{{ asset('imagenes/foro-documentos/foro-innovacion-2.png') }}" alt="First Slide">
            </div>
            <div class="col-md-6">
                    <div class="modal-header">
                        <h4 class="modal-title pull-left" style="color: #F26F21; text-align: left;"><strong>Presentaciones</strong></h4>
                    </div>
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-inverse overflow-hidden">
                            <div class="panel-heading">
                                <h3 class="panel-title ">
                                    <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                        <i class="fa fa-plus-circle pull-right"></i> 
                                        <span class="box-foro">Asociaciones Público-Privadas APP</span>  
                                    </a>
                                </h3>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Asociaciones Público-Privadas APP  | <strong>MIPRO</strong> <a href="{{ asset('imagenes/foro-documentos/Asociaciones_Publico_Privadas_MIPRO.pdf') }}" target="_blank" class="pull-right"> <i class="fa fa-sx fa-cloud-download"></i> </a>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-inverse overflow-hidden">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                        <i class="fa fa-plus-circle pull-right"></i> 
                                        Bioeconomia
                                    </a>
                                </h3>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse">
                                <div class="panel-body">
                                   Bioeconomia  | <strong>MAE</strong> <a href="{{ asset('imagenes/foro-documentos/Bioeconomia_MAE.pdf') }}" target="_blank" class="pull-right"> <i class="fa fa-sx fa-cloud-download"></i> </a>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-inverse overflow-hidden">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                        <i class="fa fa-plus-circle pull-right"></i> 
                                        Colaboración Público Privada | Compras Públicas de Innovación
                                    </a>
                                </h3>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Colaboración Público Privada  | <strong>BID</strong> <a href="{{ asset('imagenes/foro-documentos/Colaboracion_Publico_Privada_BID.pdf') }}" target="_blank" class="pull-right"> <i class="fa fa-sx fa-cloud-download"></i> </a><br>
                                    Compras PÚblicas de Innovación  | <strong>BID</strong> <a href="{{ asset('imagenes/foro-documentos/Compras_Publicas_de_Innovacion_BID.pdf') }}" target="_blank" class="pull-right"> <i class="fa fa-sx fa-cloud-download"></i> </a>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-inverse overflow-hidden">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                        <i class="fa fa-plus-circle pull-right"></i> 
                                        Economía Digital Industrial
                                    </a>
                                </h3>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Economía Digital Industrial  | <strong>BID</strong> <a href="{{ asset('imagenes/foro-documentos/Digital_Economy_Industrias_BID.pdf') }}" target="_blank" class="pull-right"> <i class="fa fa-sx fa-cloud-download"></i> </a>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-inverse overflow-hidden">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                                        <i class="fa fa-plus-circle pull-right"></i> 
                                        Zonas Economicas Especiales ZEDES
                                    </a>
                                </h3>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Zonas Economicas Especiales BID  | <strong>BID</strong> <a href="{{ asset('imagenes/foro-documentos/Zonas_Economicas_Especiales_BID.pdf') }}" target="_blank" class="pull-right"> <i class="fa fa-sx fa-cloud-download"></i> </a><br>
                                    Zonas Especiales de Desarrollo Economico| <strong>MIPRO</strong> <a href="{{ asset('imagenes/foro-documentos/Zonas_Especiales_de_Desarrollo_Economico_MIPRO.pdf') }}" target="_blank" class="pull-right"> <i class="fa fa-sx fa-cloud-download"></i> </a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
            </div>	<!-- end col-4 -->
					</div>
						<!-- end row -->
					
						<!-- end row -->

				</div>

			</div>


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



@endsection
