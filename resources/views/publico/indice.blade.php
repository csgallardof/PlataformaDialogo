@extends('layouts.main')

@section('title', 'Inicio')

@section('start_css')
  @parent
    <link href="{{ asset('plugins/DataTables/css/data-table.css') }}" rel="stylesheet" />
    <style type="text/css">
        h4 {display:inline;}
    </style>
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

			<!-- end page-header -->

			<!-- begin #about -->
			<div id="about" class="content row-m-t-2" data-scrollview="true">
					<!-- begin container -->
				<div class="container" data-animation="true" data-animation-type="fadeInDown">

					<div class="modal-header d-inline">
						<h4 class="modal-title">Índice Único de Competitividad Provincial</h4>
                        <div class="pull-right">
                            <a href="{{ asset('imagenes/competitividad/base_de_datos/IUCP_MIPRO_2017.xlsx') }}" class="btn btn-primary btn-sm">Descarga Matriz de Indicadores</a>
                            <a href="{{ url('indice/indicadoresProvincia')}}" class="btn btn-primary btn-sm">Indicadores por provincia</a>
                        </div>
					</div>

					<!-- begin row -->
					<div class="row">
							<!-- begin col-4 -->
						<div class="col-md-7">
							<div class="col-md-12">
                    
                    {{-- PILARES --}}
                    <div class="dropdown">
						<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Pilares
						<span class="caret"></span></button>
						<ul class="dropdown-menu">
						    <li><a href="#" data-toggle="modal" data-target="#modal1">Desarrollo Integral de las personas</a></li>
							<li><a href="#" data-toggle="modal" data-target="#modal2">Desempe&ntilde;o Econ&oacute;mico</a></li>
						    <li><a href="#" data-toggle="modal" data-target="#modal3">Empleo</a></li>
					    	<li><a href="#" data-toggle="modal" data-target="#modal4">Gesti&oacute;n Empresarial</a></li>
					    	<li><a href="#" data-toggle="modal" data-target="#modal5">Gesti&oacute;n, Gobiernos e Instituciones</a></li>
					    	<li><a href="#" data-toggle="modal" data-target="#modal6">Habitantes de Innovaci&oacute;n, Ciencia y Tecnolog&iacute;a</a></li>
					    	<li><a href="#" data-toggle="modal" data-target="#modal7">Infraestructura y Localizaci&oacute;n</a></li>
					    	<li><a href="#" data-toggle="modal" data-target="#modal8">Internacionalizaci&oacute;n y Apertura</a></li>
					    	<li><a href="#" data-toggle="modal" data-target="#modal9">Mercados Financieros</a></li>
					    	<li><a href="#" data-toggle="modal" data-target="#modal10">Recursos Naturales y Ambientes</a></li>
					    	<li><a href="#" data-toggle="modal" data-target="#modal11">Seguridad Jur&iacute;dica</a></li>
					    	<li><a href="#" data-toggle="modal" data-target="#modal12">Urbanizaci&oacute;n</a></li>
						</ul>
					</div>
                    {{-- FIN DE PILARES --}}

                  <hr />
                  <br />
			        </div>
							<br>
							<h4 class="m-t-20">Competitividad Global</h4><br><br>
							<div class="col-md-12">
					    		<img class="img-responsive center-block" src="{{ asset('imagenes/competitividad/global.png') }}" alt="">
					    	</div>
						</div>

						<br><br>

						<!-- METODOLOGIA-->
						<div class="col-md-5">
							<h4 class="modal-title">Metodología</h4>
							<br><br>
							<div class="panel-group" id="accordion">
								<div class="panel panel-inverse overflow-hidden">
									<div class="panel-heading">
										<h3 class="panel-title">
											<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
											    <i class="fa fa-plus-circle pull-right"></i>
												&Iacute;ndice de Competitividad.
											</a>
										</h3>
									</div>
									<div id="collapseOne" class="panel-collapse collapse in">
										<div class="panel-body">
											<ul>
												<li class="text-justify">Michael Porter extendi&oacute; la idea de que el grado en que una regi&oacute;n es competitiva var&iacute;a de acuerdo con la configuraci&oacute;n de un conjunto propio de factores internos y externos.
												</li>
												<li class="text-justify">
													El Foro Econ&oacute;mico Mundial define la competitividad como “el conjunto de instituciones, pol&iacute;ticas y factores que determinan el nivel de productividad de un pa&iacute;s”.
												</li>
												<li class="text-justify">
													Un &iacute;ndice de competitividad permite sintetizar el estado y de las ventajas competitivas de empresas o regiones que permitan generar y evaluar las pol&iacute;ticas p&uacute;blicas en el &aacute;mbito econ&oacute;mico, productivo y social.

												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="panel panel-inverse overflow-hidden">
									<div class="panel-heading">
										<h3 class="panel-title">
											<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
											    <i class="fa fa-plus-circle pull-right"></i>
												Metodolog&iacute;a de c&aacute;lculo
											</a>
										</h3>
									</div>
									<div id="collapseTwo" class="panel-collapse collapse">
										<div class="panel-body">
											<ul>
												<li class="text-justify">Se generan un total de 64 indicadores agrupados en 12 pilares de an&aacute;lisis.
												</li>
												<li class="text-justify">
													Para hacer comparable cada indicador fue necesario hacer una transformaci&oacute;n en una escala de 1 a 100.
												</li>
												<li class="text-justify">
													Los indicadores pueden apoyan u obstaculizar la competitividad de una provincia por lo que es necesario realizar ajustes en la estandarizaci&oacute;n de los indicadores:
													<br><br>
													<div class="col-md-12">
													   	<img class="img-responsive center-block" src="{{ asset('imagenes/competitividad/metodologiaCalculo.jpg') }}">
													</div>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="panel panel-inverse overflow-hidden">
									<div class="panel-heading">
										<h3 class="panel-title">
											<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
											    <i class="fa fa-plus-circle pull-right"></i>
												Composici&oacute;n del &iacute;ndice &uacute;nico de competitividad provincial
											</a>
										</h3>
									</div>
									<div id="collapseThree" class="panel-collapse collapse">
										<div class="panel-body">
											El &Iacute;ndice &uacute;nico de competitividad provincial est&aacute; compuesto por 64 indicadores agrupados en 12 pilares.
											<br><br>
											<div class="col-md-12">
												<img class="img-responsive center-block" src="{{ asset('imagenes/competitividad/tablaIndicadores.png') }}">

                                            </div>


										</div>
									</div>
								</div>

							</div>
					    </div>
						<!-- FIN DE METODOLOGIA-->

                        <!-- INDICES-->
                        <div class="col-md-5">
                        <hr> </hr>
                            <h4 class="modal-title">Indicadores por pilar de competitividad</h4>
                            <br>
                            <div class="panel-group" id="accordion1">
                                <div class="panel panel-inverse overflow-hidden">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion1" href="#collapseIuno">
                                                <i class="fa fa-plus-circle pull-right"></i>
                                                Desarrollo Integral de las personas
                                            </a>
                                        </h3>
                                    </div>
                                    <div id="collapseIuno" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <h6>(6 Indicadores) Supone que a mayor educación, menor pobreza y menor mortalidad más competitividad</h6>
                                            <ul>
                                                <li class="text-justify">Años de escolaridad.</li>
                                                <li class="text-justify">Pobreza</li>
                                                <li class="text-justify">Tasa bruta de asistencia secundaria</li>
                                                <li class="text-justify">Tasa bruta de asistencia superior</li>
                                                <li class="text-justify">Tasa de mortalidad infantil</li>
                                                <li class="text-justify">Tasa de Repitencia y Deserción Escolar</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-inverse overflow-hidden">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapseIdos">
                                                <i class="fa fa-plus-circle pull-right"></i>
                                                Desempeño Económico
                                            </a>
                                        </h3>
                                    </div>
                                    <div id="collapseIdos" class="panel-collapse collapse">
                                        <div class="panel-body">
                                             <h6>( 9 indicadores) A mayor producción, mayor valor agregado, menor concentración y menor desigualdad; mayor competitividad </h6>
                                            <ul>
                                                <li class="text-justify">Coeficiente de Gini</li>
                                                <li class="text-justify">Impuestos pagados</li>
                                                <li class="text-justify">Índice de concentración</li>
                                                <li class="text-justify">Producción</li>
                                                <li class="text-justify">Producción Per Cápita (No petrolera)</li>
                                                <li class="text-justify">Productividad Media del trabajo según</li>
                                                <li class="text-justify">Producción Total</li>
                                                <li class="text-justify">Productividad Media del trabajo según </li>
                                                <li class="text-justify">Valor Agregado</li>
                                                <li class="text-justify">Valor Agregado Per Cápita (No Petrolero)</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-inverse overflow-hidden">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapseItres">
                                                <i class="fa fa-plus-circle pull-right"></i>
                                                Empleo
                                            </a>
                                        </h3>
                                    </div>
                                    <div id="collapseItres" class="panel-collapse collapse">
                                        <div class="panel-body">
                                           (4 indicadores) A más empleo, y menor desempleo; mayor competitividad
                                            <ul>
                                                <li class="text-justify">Tasa de empleo rural</li>
                                                <li class="text-justify">Tasa de empleo urbano</li>
                                                <li class="text-justify">Tasa de subempleo rural</li>
                                                <li class="text-justify">Tasa de subempleo urbano</li>

                                            </ul>


                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-inverse overflow-hidden">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">
                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapseIcuatro">
                                                    <i class="fa fa-plus-circle pull-right"></i>
                                                    Gestión Empresarial
                                                </a>
                                            </h3>
                                        </div>
                                        <div id="collapseIcuatro" class="panel-collapse collapse">
                                            <div class="panel-body">
                                               (4 indicadores) A mayor cantidad de activos , empresas, industrias y Pymes; mayor competitividad provincial
                                                <ul>
                                                    <li class="text-justify">Activos empresariales</li>
                                                    <li class="text-justify">Empresas registradas</li>
                                                    <li class="text-justify">Industrias</li>
                                                    <li class="text-justify">PYMES</li>

                                                </ul>


                                            </div>
                                        </div>
                                </div>

                                <div class="panel panel-inverse overflow-hidden">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">
                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapseIcinco">
                                                    <i class="fa fa-plus-circle pull-right"></i>
                                                    Infraestructura y Localización
                                                </a>
                                            </h3>
                                        </div>
                                        <div id="collapseIcinco" class="panel-collapse collapse">
                                            <div class="panel-body">
                                               (4 indicadores) A mayor cobertura de telefonía, mayor cantidad de vías asfaltadas , menor distancia a puertos y aeropuertos; mayor competitividad
                                                <ul>
                                                    <li class="text-justify">Cobertura teléfono fijo</li>
                                                    <li class="text-justify">Distancia a aeropuertos inter</li>
                                                    <li class="text-justify">Distancia a puertos inter.</li>
                                                    <li class="text-justify">Km vías asfaltadas</li>

                                                </ul>


                                            </div>
                                        </div>
                                </div>


                                <div class="panel panel-inverse overflow-hidden">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">
                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapseIseis">
                                                    <i class="fa fa-plus-circle pull-right"></i>
                                                    Seguridad Jurídica
                                                </a>
                                            </h3>
                                        </div>
                                        <div id="collapseIseis" class="panel-collapse collapse">
                                            <div class="panel-body">
                                               (4 Indicadores) A mayor capacidad de recursos físicos y de personal; y menor cantidad de delitos ; mayor competitividad.
                                                <ul>
                                                    <li class="text-justify">Delitos a personas y propiedad</li>
                                                    <li class="text-justify">Efectividad detenciones</li>
                                                    <li class="text-justify">Personal de justicia</li>
                                                    <li class="text-justify">Unidades judiciales y servicios</li>

                                                </ul>


                                            </div>
                                        </div>
                                </div>


                                <div class="panel panel-inverse overflow-hidden">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">
                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapseIsiete">
                                                    <i class="fa fa-plus-circle pull-right"></i>
                                                    Internacionalización y Apertura
                                                </a>
                                            </h3>
                                        </div>
                                        <div id="collapseIsiete" class="panel-collapse collapse">
                                            <div class="panel-body">
                                               (4 Indicadores)A mayor capacidad exportadora e inversión mayor competitividad
                                                <ul>
                                                    <li class="text-justify">Empresas exportadoras</li>
                                                    <li class="text-justify">Exportación (No petroleros) per cápita</li>
                                                    <li class="text-justify">Exportaciones (No petroleros)</li>
                                                    <li class="text-justify">Inversión Extranjera</li>

                                                </ul>


                                            </div>
                                        </div>
                                </div>


                                <div class="panel panel-inverse overflow-hidden">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">
                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapseIsiete">
                                                    <i class="fa fa-plus-circle pull-right"></i>
                                                    Gestión, Gobiernos e Instituciones
                                                </a>
                                            </h3>
                                        </div>
                                        <div id="collapseIsiete" class="panel-collapse collapse">
                                            <div class="panel-body">
                                               (5 Indicadores) A mayor gastos , capacidad de generar ingresos e inversión; y número de gobiernos mayor competitividad
                                                <ul>
                                                    <li class="text-justify">Endeudamiento</li>
                                                    <li class="text-justify">Gasto social</li>
                                                    <li class="text-justify">Gobiernos Sub-nacionales</li>
                                                    <li class="text-justify">Ingresos propios</li>
                                                    <li class="text-justify">Inversión</li>


                                                </ul>


                                            </div>
                                        </div>
                                </div>


                                <div class="panel panel-inverse overflow-hidden">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">
                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapseIocho">
                                                    <i class="fa fa-plus-circle pull-right"></i>
                                                    Mercados financieros
                                                </a>
                                            </h3>
                                        </div>
                                        <div id="collapseIocho" class="panel-collapse collapse">
                                            <div class="panel-body">
                                               (9 Indicadores) A mayor cantidad de recursos colocados y desembolsados, menor nivel de morosidad y mayor cobertura con sucursales bancarias; mejor competitividad.
                                                <ul>
                                                    <li class="text-justify">Cartera a sistema financiero</li>
                                                    <li class="text-justify">Cartera productiva en la provincia</li>
                                                    <li class="text-justify">Cartera productiva per cápita</li>
                                                    <li class="text-justify">Depósitos en sistema financiero</li>
                                                    <li class="text-justify">Depósitos en sistema financiero para población</li>
                                                    <li class="text-justify">Microcrédito en provincia</li>
                                                    <li class="text-justify">Microcrédito para población</li>
                                                    <li class="text-justify">Morosidad en provincia</li>
                                                    <li class="text-justify">No. Sucursales bancarias</li>


                                                </ul>


                                            </div>
                                        </div>
                                </div>


                                <div class="panel panel-inverse overflow-hidden">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">
                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapseInueve">
                                                    <i class="fa fa-plus-circle pull-right"></i>
                                                    Recursos Naturales y Ambiente
                                                </a>
                                            </h3>
                                        </div>
                                        <div id="collapseInueve" class="panel-collapse collapse">
                                            <div class="panel-body">
                                               (2 indicadores)A mayor cantidad de recursos naturales mayor competitividad
                                                <ul>
                                                    <li class="text-justify">Bosques y páramos</li>
                                                    <li class="text-justify">Superficie cultivada</li>


                                                </ul>


                                            </div>
                                        </div>
                                </div>


                                <div class="panel panel-inverse overflow-hidden">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">
                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapseInueve">
                                                    <i class="fa fa-plus-circle pull-right"></i>
                                                    Urbanización
                                                </a>
                                            </h3>
                                        </div>
                                        <div id="collapseInueve" class="panel-collapse collapse">
                                            <div class="panel-body">
                                               (6 indicadores) Mientras más urbanizada sea la provincia y mejor cobertura de servicios; mayor competitividad
                                                <ul>
                                                    <li class="text-justify">% Fuerza laboral</li>
                                                    <li class="text-justify">% Población urbana</li>
                                                    <li class="text-justify">Cobertura agua potable</li>
                                                    <li class="text-justify">Cobertura electricidad</li>
                                                    <li class="text-justify">Costo electricidad</li>
                                                    <li class="text-justify">Densidad poblacional</li>


                                                </ul>


                                            </div>
                                        </div>
                                </div>

                                <div class="panel panel-inverse overflow-hidden">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">
                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapseIdiez">
                                                    <i class="fa fa-plus-circle pull-right"></i>
                                                    Habilitantes de Innovación, Ciencia y Tecnología
                                                </a>
                                            </h3>
                                        </div>
                                        <div id="collapseIdiez" class="panel-collapse collapse">
                                            <div class="panel-body">
                                               (6 indicadores) Mientras más profesionales, cobertura de internet, telefonía celular y número de universidades y carreras universitarias, mayor competitividad
                                                <ul>
                                                    <li class="text-justify">Cobertura internet</li>
                                                    <li class="text-justify">Cobertura teléfono celular</li>
                                                    <li class="text-justify">Inversión de IyD de empresas</li>
                                                    <li class="text-justify">Investigadores por provincia</li>
                                                    <li class="text-justify">Personas con Postgrado</li>
                                                    <li class="text-justify">Universidades e instit. Superiores</li>
                                                    <li class="text-justify">Número de Carreras Universitarias</li>

                                                </ul>


                                            </div>
                                        </div>
                                </div>


                        </div>
                        <!-- FIN DE INDICES-->

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

<!-- VENTANA MODAL PARA  DE CONCURSO -->

    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <br>
                    <h4>Desarrollo Integral de las personas</h4>
                </div>
                <div class="modal-body">
                	<img class="img-responsive center-block" src="{{ asset('imagenes/competitividad/desarrollo.png') }}" alt="">
                	<br>
                </div>
            </div>
        </div>
    </div>
     <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <br>
                    <h4>Desempe&ntilde;o Econ&oacute;mico</h4>
                </div>
                <div class="modal-body">
                	<img class="img-responsive center-block" src="{{ asset('imagenes/competitividad/desempeno.png') }}" alt="">
                	<br>
                </div>
            </div>s
        </div>
    </div>
     <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <br>
                    <h4>Empleo</h4>
                </div>
                <div class="modal-body">
                	<img class="img-responsive center-block" src="{{ asset('imagenes/competitividad/empleo.png') }}" alt="">
                	<br>
                </div>
            </div>
        </div>
    </div>
     <div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <br>
                    <h4>Gesti&oacute;n Empresarial</h4>
                </div>
                <div class="modal-body">
                	<img class="img-responsive center-block" src="{{ asset('imagenes/competitividad/gestionEmpresarial.png') }}" alt="">
                	<br>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <br>
                    <h4>Gesti&oacute;n, Gobiernos e Instituciones</h4>
                </div>
                <div class="modal-body">
                	<img class="img-responsive center-block" src="{{ asset('imagenes/competitividad/gestionGobiernos.png') }}" alt="">
                	<br>
                </div>
            </div>
        </div>
    </div>

     <div class="modal fade" id="modal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <br>
                    <h4>Habitantes de Innovaci&oacute;n, Ciencia y Tecnolog&iacute;a</h4>
                </div>
                <div class="modal-body">
                	<img class="img-responsive center-block" src="{{ asset('imagenes/competitividad/habitantes.png') }}" alt="">
                	<br>
                </div>
            </div>
        </div>
    </div>

     <div class="modal fade" id="modal7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <br>
                    <h4>Infraestructura y Localizaci&oacute;n</h4>
                </div>
                <div class="modal-body">
                	<img class="img-responsive center-block" src="{{ asset('imagenes/competitividad/infraestructura.png') }}" alt="">
                	<br>
                </div>
            </div>
        </div>
    </div>
     <div class="modal fade" id="modal8" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <br>
                    <h4>Internacionalizaci&oacute;n y Apertura</h4>
                </div>
                <div class="modal-body">
                	<img class="img-responsive center-block" src="{{ asset('imagenes/competitividad/internacionalizacion.png') }}" alt="">
                	<br>
                </div>
            </div>
        </div>
    </div>
     <div class="modal fade" id="modal9" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <br>
                    <h4>Mercados Financieros</h4>
                </div>
                <div class="modal-body">
                	<img class="img-responsive center-block" src="{{ asset('imagenes/competitividad/mercados.png') }}" alt="">
                	<br>
                </div>
            </div>
        </div>
    </div>
     <div class="modal fade" id="modal10" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <br>
                    <h4>Recursos Naturales y Ambientes</h4>
                </div>
                <div class="modal-body">
                	<img class="img-responsive center-block" src="{{ asset('imagenes/competitividad/recursosNaturales.png') }}" alt="">
                	<br>
                </div>
            </div>
        </div>
    </div>
     <div class="modal fade" id="modal11" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <br>
                    <h4>Seguridad Jur&iacute;dica</h4>
                </div>
                <div class="modal-body">
                	<img class="img-responsive center-block" src="{{ asset('imagenes/competitividad/seguridad.png') }}" alt="">
                	<br>
                </div>
            </div>
        </div>
    </div>
     <div class="modal fade" id="modal12" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                	<br>
                    <h4>Urbanizaci&oacute;n</h4>
                </div>
                <div class="modal-body">
                	<img class="img-responsive center-block" src="{{ asset('imagenes/competitividad/urbanizacion.png') }}" alt="">
                	<br>
                </div>
            </div>
        </div>
    </div>

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
