@extends('layouts.main')

@section('title', 'Inicio')

@section('start_css')
  @parent
  	<link href="{{ asset('plugins/DataTablesv2/datatables.css') }}" rel="stylesheet" />
    	<link href="{{ asset('css/style-after.css') }}" rel="stylesheet" />
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
					<div class="row">
							<!-- begin col-4 -->



						<div id="" class="modal-header">
							<h2 class="modal-title "><strong>Estructura promedio de Costos y Gastos de las empresas registradas como manufactureras</strong></h2>
						</div>
						{{-- tabla de costos --}}

						<div class="row">

					<div class="col-md-12">


							<table id="data-table" class="table nowrap table-striped table-bordered" width="60%">
								<thead>

					          <th class="text-center">Rubro</th>
								    <th class="text-center">2014</th>
								    <th class="text-center">2015</th>
								    <th class="text-center">2016</th>
								</thead>
								<tbody>
					        	    <tr>
									    <td class="text-left">Sueldos, salarios, honorarios y beneficios sociales</td>
									    <td class="text-center">26,30%</td>
									    <td class="text-center">25,60%</td>
									    <td class="text-center">24,70%</td>
									  </tr>
									  <tr>
									    <td class="text-left">Bienes no producidos por el sujeto pasivo</td>
									    <td class="text-center">17,30%</td>
									    <td class="text-center">18,00%</td>
									    <td class="text-center">18,50%</td>
									  </tr>
									  <tr>
									    <td class="text-left">Materia prima</td>
									    <td class="text-center">17,80%</td>
									    <td class="text-center">16,40%</td>
									    <td class="text-center">15,40%</td>
									  </tr>
									  <tr>
									    <td class="text-left">Suministros, herramientas, materiales y repuestos</td>
									    <td class="text-center">5,10%</td>
									    <td class="text-center">5,60%</td>
									    <td class="text-center">5,20%</td>
									  </tr>
									  <tr>
									    <td class="text-left">Mantenimiento y reparaciones</td>
									    <td class="text-center">2,90%</td>
									    <td class="text-center">2,80%</td>
									    <td class="text-center">2,90%</td>
									  </tr>
									  <tr>
									    <td class="text-left">Servicios públicos</td>
									    <td class="text-center">1,60%</td>
									    <td class="text-center">1,70%</td>
									    <td class="text-center">1,80%</td>
									  </tr>
									  <tr>
									    <td class="text-left">Arrendamientos operativos</td>
									    <td class="text-center">1,30%</td>
									    <td class="text-center">1,50%</td>
									    <td class="text-center">1,50%</td>
									  </tr>
									  <tr>
									    <td class="text-left">Transporte</td>
									    <td class="text-center">1,00%</td>
									    <td class="text-center">1,30%</td>
									    <td class="text-center">1,40%</td>
									  </tr>
									  <tr>
									    <td class="text-left">Consumo de combustibles y lubricantes</td>
									    <td class="text-center">0,50%</td>
									    <td class="text-center">0,60%</td>
									    <td class="text-center">0,70%</td>
									  </tr>
									  <tr>
									    <td class="text-left">Promoción y publicidad</td>
									    <td class="text-center">0,50%</td>
									    <td class="text-center">0,50%</td>
									    <td class="text-center">0,50%</td>
									  </tr>
									  <tr>
									    <td class="text-left">Otros costos y gastos</td>
									    <td class="text-center">25,80%</td>
									    <td class="text-center">25,90%</td>
									    <td class="text-center">27,50%</td>
									  </tr>
									  <!-- <tr>
									    <td class="text-left"><strong>Total costos y gastos</strong></td>
									    <td class="text-center"><strong>100,00%</strong></td>
									    <td class="text-center"><strong>100,00%</strong></td>
									    <td class="text-center"><strong>100,00%</strong></td>
									  </tr> -->

			     				</tbody>
							</table>


						<!-- Fin Contenido -->
					</div>
						<!-- end col-4 -->
				</div>



						{{-- fin tabla cotos --}}





						<div class="h5" style="text-align: justify;">
						<div>&nbsp;</div>
							<div><span style="text-decoration: underline;"><strong>Fuente:</strong></span> SRI, declaraciones en formulario 101</div>
							<div><em>Se consideran empresas que registran costos superiores a cero y se excluyen empresas que declaran costos y gastos en los rubros analizados superiores al total de costos y gastos reportado en cada ejercicio fiscal.</em></div>
							<div><span style="text-decoration: underline;">N&uacute;mero de empresas por a&ntilde;o: </span></div>
							<div>2014: <em>4662 empresas</em></div>
							<div>2015: <em>4918 empresas</em></div>
							<div>2016: <em>5106 empresas&nbsp;</em></div>

						</div>




							<!-- end col-4 -->
					</div>

				</div>

			</div>
			<!-- end #about -->

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


@endsection

@section('init_scripts')



@endsection

@section('end_js')
  @parent

  <script>

		$(document).ready(function() {
			App.init();
			TablaBasica.init();
		});

	</script>

@endsection
