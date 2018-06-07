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

					<div class="col-md-12 m-t-20">

						<!-- begin breadcrumb -->
						<ol class="breadcrumb pull-right">
							<li><a href="{{ url('app') }}">Home</a></li>
							<li class="active">&Iacute;ndice &Uacute;nico de Competitividad Provincial</li>
						</ol>
						<!-- end breadcrumb -->

					</div>

				</div>

			</div>

		</div>
		<!-- end container -->

			<!-- begin #about -->
			<div id="about" class="content row-m-t-2" data-scrollview="true">
					<!-- begin container -->
					<div class="container" data-animation="true" data-animation-type="fadeInDown">

							<!-- begin row -->
							<div class="row">

                <div class="col-md-12">

                  <div class="modal-header">
        							<h4 class="modal-title"><strong>¿Por qué invertir en Ecuador?</strong></h4>
        					</div>

                  El Ecuador es una República de Oportunidades. El propósito del Gobierno del Ecuador es promover la atracción de inversión a través de la efectividad de políticas públicas para promover el empleo, el desarrollo de proyectos priorizados de inversión, hacia la transformación productiva, económica y social. El fin es hacer del Ecuador un país de prosperidad para todos.
                  <br /><br />
                  El Ecuador lleva a cabo un Plan Estratégico de Movilidad (2013-2037),  que posee cinco ejes importantes: unidad (la aplicación de un sistema nacional), integración (se ejecutará en todo el territorio), conexión (la red tendrá continuidad), multimodal (abarca la movilización por aire, tierra, ríos y mares) y totalidad (el plan contará con estándares ajustados a la movilidad en la época actual).
                  Se cuenta con 17  aeropuertos operativos para lo cual se invirtió aproximadamente USD 373 millones en el período 2007-2016. Para  el mediano plazo se pretende impulsar la operatividad de otros aeropuertos inactivos.
                  <br /><br />
                  Con la Política de Movilidad Fluvial se busca impulsar el desarrollo comercial a nivel regional con países limítrofes como Perú, Colombia y Brasil,  5 marítimos (1 en construcción) y 1 puerto fluvial, con una inversión de USD 24,3 MM (2007-2016).
                  Entre estos, en la provincia del Guayas, la construcción del  Puerto de  Aguas Profundas que comprende la construcción de una carretera de 20 kilómetros que conectará Posorja con Playas, el dragado del canal de acceso y la edificación de la terminal con un muelle de 400 metros de largo y un patio para 750.000 contenedores.
                  <br /><br />
                  Por otro lado, el Plan Maestro de Electrificación 2013-2022 garantiza el suministro del servicio de energía eléctrica a todos los sectores productivos del país mediante programas de: Eficiencia Energética e Integración Energética Regional. Por medio de Proyectos Hidroeléctricos (ToachiPilatón, Coca Codo Sinclair, Sopladora, Mazar entre otros) se busca abastecer  la demanda nacional de energía eléctrica para todos los actores de la economía del país, y a un menor costo.

                </div>

							</div>
							<!-- end row -->

					</div>
					<!-- end container -->
			</div>
			<!-- end #about -->

      <!-- begin #about -->
			<div id="about" class="content row-m-t-2" data-scrollview="true">
					<!-- begin container -->
					<div class="container" data-animation="true" data-animation-type="fadeInDown">

							<!-- begin row -->
							<div class="row">

                <div class="col-md-12">

                  <div class="modal-header">
        							<h4 class="modal-title"><strong>¿Qué instrumentos ofrece el Ecuador para beneficio del inversionista?</strong></h4>
        					</div>

                  Conforme lo indica el Código Orgánico de la Producción, Comercio e Inversiones, el Consejo Sectorial de la Producción es el máximo órgano de rectoría gubernamental en materia de inversiones. 
                  <br /><br />

                  Enmarcado en los principios de la Constitución y el Buen Vivir, se establece la construcción de un sistema económico justo, democrático, productivo, solidario y sostenible, basado en la distribución equitativa de los beneficios del desarrollo. Ecuador dispone del El Código Orgánico de la Producción, Comercio e Inversiones (COPCI) que regula las reglas del proceso productivo en su conjunto, ofrece mayores seguridades e incentivos para el inversionista nacional y extranjero; y fomenta la transformación de la matriz productiva.

                  <br /><br />Sus beneficios para inversionistas están protegidos por la Ley Orgánica de Incentivos para las Asociaciones Público-Privadas y la Inversión Extranjera, los cuales además tienen el carácter de acumulativo por lo que, dependiendo del tipo de inversión, una empresa o asociación puede acceder a varios incentivos al mismo tiempo. Los incentivos tributarios otorgados a las empresas que creen en el país, son esfuerzos asumidos por el Estado, pero constituyen una muestra de confianza del Ecuador en el sector empresarial.

                </div>

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



@endsection
