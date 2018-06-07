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
			<div id="contratos" class="content row-m-t-2" data-scrollview="true">

					<!-- begin container -->
				<div class="container" data-animation="true" data-animation-type="fadeInDown">

					<!-- begin row -->
					<div class="row m-t-20">
							<!-- begin col-4 -->
						<!-- ini kir inversionista  -->

              <a href="/invertir_en_el_ecuador" class="btn btn-info" role="button">¿Por qué invertir en Ecuador?</a>
              <a href="#contratos" class="btn btn-info" role="button">Contratos de Inversión</a>
              <a href="#proceso" class="btn btn-info" role="button">Proceso Firma de Contratos</a>
              <a href="#base" class="btn btn-info" role="button">Base Legal</a>
              <a href="#incentivos" class="btn btn-info" role="button">Incentivos</a>

              <br /><br />

						<div id="" class="modal-header">
							<h4 class="modal-title "><strong>Contratos de Inversión con el Estado Ecuatoriano</strong></h4>
						</div>

            <p>
              Un contrato de inversión es un acuerdo opcional que el empresario puede solicitar al Estado ecuatoriano para asegurar su inversión. El MIPRO reconoce las inversiones de hasta 15 años plazo con un capital desde un millón de dólares.
            </p>

            <div class="col-md-6">
              <img class="text-center" width="80%" src="{{ asset('imagenes/inversiones/contratos_de_inversion_1.jpg') }}" alt="Azuay">
            </div>

							<!-- end col-4 -->
					</div>

				</div>

			</div>
			<!-- end #about -->

      <!-- begin #about -->
			<div id="proceso" class="content row-m-t-2" data-scrollview="true">
					<!-- begin container -->
				<div class="container" data-animation="true" data-animation-type="fadeInDown">

					<!-- begin row -->
					<div class="row m-t-20">
							<!-- begin col-4 -->
						<!-- ini kir inversionista  -->

						<div id="proceso" class="modal-header">
							<h4 class="modal-title "><strong>Proceso para la Firma de Contratos de Inversión</strong></h4>
						</div>

            <p>
              1. Contacto con el inversionista<br />
              2. Envío del KIT DEL INVERSIONISTA, con los requisitos correspondientes<br />
              3. Ingreso oficial del proceso de inversión<br />
              4. Verificación de anexos<br />
              5. Elaboración de informe<br />
              6. Decisión del Consejo Sectorial de la Producción<br />
              7. Firma del contrato
            </p>

							<!-- end col-4 -->
					</div>

				</div>

			</div>
			<!-- end #about -->

      <!-- begin #about -->
			<div id="base" class="content row-m-t-2" data-scrollview="true">
					<!-- begin container -->
				<div class="container" data-animation="true" data-animation-type="fadeInDown">

					<!-- begin row -->
					<div class="row m-t-20">
							<!-- begin col-4 -->
						<!-- ini kir inversionista  -->

						<div id="base" class="modal-header">
							<h4 class="modal-title "><strong>Base Legal</strong></h4>
						</div>

            <a href="{{ asset('archivos/base_legal_inversiones/copci.pdf') }}"><span class="fa fa-link"></span>&nbsp;&nbsp;&nbsp;CÓDIGO ORGÁNICO DE LA PRODUCCIÓN, COMERCIO E INVERSIONES</a><br />
            <a href="{{ asset('archivos/base_legal_inversiones/reglamento_copci.pdf') }}"><span class="fa fa-link"></span>&nbsp;&nbsp;&nbsp;REGLAMENTO A LA ESTRUCTURA DE DESARROLLO PRODUCTIVO DE INVERSION</a><br />
            <a href="{{ asset('archivos/base_legal_inversiones/comex_82.pdf') }}"><span class="fa fa-link"></span>&nbsp;&nbsp;&nbsp;Resolución Nro. 82 COMEX</a><br />

							<!-- end col-4 -->
					</div>

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
							<h4 class="modal-title"><strong>Incentivos para el Inversionista</strong></h4>
						</div>

						<div class="col-md-12">
					        <div class="panel-group" id="accordion">
								<div class="panel panel-inverse overflow-hidden">
									<div class="panel-heading">
										<h3 class="panel-title">
											<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
											    <i class="fa fa-plus-circle pull-right"></i>
                          Incentivos Generales
											</a>
										</h3>
									</div>
									<div id="collapseOne" class="panel-collapse collapse in">
										<div class="panel-body">

                      <div class="col-md-6">
                        <img class="img-responsive center-block"  src="{{ asset('imagenes/incentivos/incentivos_generales_1.jpg') }}" alt="Azuay">
                      </div>

                      <div class="col-md-6">
                        <img class="img-responsive center-block"  src="{{ asset('imagenes/incentivos/incentivos_generales_2.jpg') }}" alt="Azuay">
                      </div>

										</div>
									</div>
								</div>
								<div class="panel panel-inverse overflow-hidden">
									<div class="panel-heading">
										<h3 class="panel-title">
											<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
											    <i class="fa fa-plus-circle pull-right"></i>
                          Incentivos Sectoriales: Inversiones en Sectores Prioritarios
											</a>
										</h3>
									</div>
									<div id="collapseTwo" class="panel-collapse collapse">
										<div class="panel-body">

                        <div class="col-md-6">
                          <img class="img-responsive center-block"  src="{{ asset('imagenes/incentivos/incentivos_sectoriales_1.jpg') }}" alt="Azuay">
                        </div>

                        <div class="col-md-6">
                          <img class="img-responsive center-block"  src="{{ asset('imagenes/incentivos/incentivos_sectoriales_2.jpg') }}" alt="Azuay">
                        </div>

										</div>
									</div>
								</div>
								<div class="panel panel-inverse overflow-hidden">
									<div class="panel-heading">
										<h3 class="panel-title">
											<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
											    <i class="fa fa-plus-circle pull-right"></i>
                          Incentivos para Zona Especial de Desarrollo Económico (ZEDE)
											</a>
										</h3>
									</div>
									<div id="collapseThree" class="panel-collapse collapse">
										<div class="panel-body">

                      <div class="col-md-6">
                        <img class="img-responsive center-block"  src="{{ asset('imagenes/incentivos/incentivos_zedes_1.jpg') }}" alt="Azuay">
                      </div>

                      <div class="col-md-6">
                        <img class="img-responsive center-block"  src="{{ asset('imagenes/incentivos/incentivos_zedes_2.jpg') }}" alt="Azuay">
                      </div>

										</div>
									</div>
								</div>
								<div class="panel panel-inverse overflow-hidden">
									<div class="panel-heading">
										<h3 class="panel-title">
											<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
											    <i class="fa fa-plus-circle pull-right"></i>
                          Incentivo Territorial
											</a>
										</h3>
									</div>
									<div id="collapseFour" class="panel-collapse collapse">
										<div class="panel-body">

                      <div class="col-md-6">
                        <img class="img-responsive center-block"  src="{{ asset('imagenes/incentivos/Incentivos Territoriales_1.jpg') }}" alt="Azuay">
                      </div>

										</div>
									</div>
								</div>
							</div>
					    </div>
						<!-- fin kit inversionista -->

							<!-- end col-4 -->
					</div>
						<!-- end row -->
					<div class="row">
							<!-- begin col-4 -->
						<div class="col-md-12">
							<div class="panel bg-yellow">

							</div>
							<!-- begin page-header -->
						</div>
							<!-- end col-4 -->
					</div>
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
