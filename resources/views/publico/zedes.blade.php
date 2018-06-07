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

              <!-- <a href="/invertir_en_el_ecuador" class="btn btn-info" role="button">¿Por qué invertir en Ecuador?</a>
              <a href="#contratos" class="btn btn-info" role="button">Contratos de Inversión</a>
              <a href="#proceso" class="btn btn-info" role="button">Proceso Firma de Contratos</a>
              <a href="#base" class="btn btn-info" role="button">Base Legal</a>
              <a href="#incentivos" class="btn btn-info" role="button">Incentivos</a> -->

              

						<div id="" class="modal-header">
							<h4 class="modal-title "><strong>Zonas Especiales de Desarrollo Económico (ZEDE)</strong></h4>
						</div>

				            <p style="text-align: justify;">
				              Las Zonas Especiales de Desarrollo Económico (ZEDE), se crearon como destinos aduaneros en espacios delimitados del territorio nacional para el asentamiento de nuevas inversiones orientadas a incentivar exportaciones con mayor valor agregado, sustituir importaciones, mejorar servicios logísticos y generar nuevas fuentes de empleo y divisas.
				              	<br>
								Las ZEDE pueden ser de tres tipos: industriales, logísticas y tecnológicas, pudiendo cada ZEDE tener una o todas las tipologías mencionadas.  
								<br>
								<ul>
									<li>Aquellas empresas que se instalen dentro de las ZEDE como administradores y operadores tendrán los siguientes incentivos:
								Rebaja de 5% en tarifa del Impuesto a la Renta.</li>
									<li>Crédito tributario por IVA pagado en compras locales, de servicios, insumos y materias primas para procesos productivos.</li>
									<li>Exoneración ISD por importaciones de bienes y servicios, y amortización de capital e intereses generados sobre créditos otorgados por instituciones financieras internacionales. </li>
									<li>Tarifa cero a transferencias e importaciones de bienes  para  procesos de transformación productiva.</li>
								</ul>
							<div id="proceso" class="modal-header">
								<h4 class="modal-title "><strong>En el país se han establecido las siguientes ZEDE:</strong></h4>
							</div>
							
								<ul>
									<li>ZEDE YACHAY en Urcuquí</li>
									<li>ZEDE Eloy Alfaro en Manta</li>
									<li>ZEDE Posorja (Puerto de aguas profundas) en Guayaquil</li>
									<li>ZEDE del Litoral (ESPOL) en Guayaquil</li>
								</ul>



							Las Zonas Especiales de Desarrollo Económico constituyen un instrumento para la captación de inversiones en el país, ofreciendo incentivos tributarios y arancelarios establecidos en la Ley, que permiten brindar confianza al inversionista.	
								
								

				            </p>

            
							<!-- end col-4 -->
					</div>

				</div>

			</div>
			<!-- end #about -->


		<!-- begin #team -->
<!--         <div id="team" class="content team" data-scrollview="true">

            <div class="container" data-animation="true" data-animation-type="fadeInDown">
                <div class="row">
                    <div class="col-12"><h4><strong>ZEDES<span style="color: #F26F21"> en Ecuador</span></strong></h4></div>
                    <br>
                    
                </div>

                <div class="row">
                    <div class="col-md-3 box">
                        <div class="container2">
                          <a href="/cifras"><img src="{{ asset('imagenes/cifras-home-inteligencia.png') }}" style="width:100%;"></a>
                          <div class="text-block2 img-over">
                            
                            <p style="margin-bottom: 0px;color:#F26F21;">ZEDE YACHAY en Urcuquí</p>
                          </div>
                        </div>

                    </div>
                    <div class="col-md-3 box">
                        <div class="container2">
                          <a href="/indice"><img src="{{ asset('imagenes/cifras-home-inteligencia-2-front.png') }}" style="width:100%;"></a>
                          <div class="text-block2 img-over">
                            
                            <p style="margin-bottom: 0px;color:#F26F21;">ZEDE Eloy Alfaro en Manta</p>
                          </div>
                        </div>
                        
                    </div>
                    <div class="col-md-3 box">
                        <div class="container2">
                          <a href="/vocaciones"><img src="{{ asset('imagenes/vocaciones-productivas-front.png') }}" style="width:100%;"></a>
                          <div class="text-block2 img-over">
                            
                            <p style="margin-bottom: 0px;color:#F26F21;">ZEDE Posorja (Puerto de aguas profundas) en Guayaquil</p>
                          </div>
                        </div>

                    </div>
                    <div class="col-md-3 box">
                        <div class="container2">
                          <a href="http://servicios.industrias.gob.ec/biblioteca/" target="_blank"><img src="{{ asset('imagenes/biblioteca-front-2.png') }}" style="width:100%;"></a>
                          <div class="text-block2 img-over">
                            
                            <p style="margin-bottom: 0px;color:#F26F21;">ZEDE del Litoral (ESPOL) en Guayaquil</p>
                          </div>
                        </div>
                        
                    </div>
                    
                    
                </div>

            </div>

        </div> -->
        <!-- end #team -->


      

      

     

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
