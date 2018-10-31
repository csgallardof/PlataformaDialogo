@extends('layouts.main')

@section('title', 'Reportes del Consejo Consultivo Productivo Tributario')

@section('start_css')
  @parent
  	<link href="{{ asset('plugins/DataTablesv2/datatables.css') }}" rel="stylesheet" />
	<link href="{{ asset('css/style-after.css') }}" rel="stylesheet" />

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    	  google.charts.load('current', {packages:['corechart']});
	      google.charts.setOnLoadCallback(drawStuff);

	        function drawStuff() {
	          var data = new google.visualization.DataTable();
	          data.addColumn('string', 'Cadena SIPOC');
	          data.addColumn('number', 'Propuestas');
	          data.addRows([

	          	@foreach($sipoc as $sipocs)
              	  ['{{ $sipocs ->nombre_sipoc }}',{{ $sipocs ->total}}],  
              	@endforeach
	          ]);

	         var options = {
	           title: 'Número de Propuestas por Cadena Productiva',
	           width: 600,
	           height: 300,
	           legend: 'none',
	           bar: {groupWidth: '95%'},
	           vAxis: { gridlines: { count: 4 } }
	         };

	         var chart = new google.visualization.ColumnChart(document.getElementById('number_format_chart'));
	         chart.draw(data, options);

	         document.getElementById('format-select').onchange = function() {
	           options['vAxis']['format'] = this.value;
	           chart.draw(data, options);
	         };
	      };  
      
    </script>

    <script type="text/javascript">
    	  google.charts.load('current', {packages:['corechart']});
	      google.charts.setOnLoadCallback(drawStuff);

	        function drawStuff() {
	          var data = new google.visualization.DataTable();
	          data.addColumn('string', 'Cadena SIPOC');
	          data.addColumn('number', 'Propuestas');
	          data.addRows([

	          	@foreach($propuestas_institucion as $propuestas_institucions)
              	  ['{{ $propuestas_institucions ->responsable_solucion }}',{{ $propuestas_institucions ->total}}],  
              	@endforeach
	          ]);

	         var options = {
	           title: 'Actividades registradas por Instituciónes',
	           width: 900,
	           height: 300,
	           legend: 'none',
	           bar: {groupWidth: '95%'},
	           vAxis: { gridlines: { count: 4 } }
	         };

	         var chart = new google.visualization.ColumnChart(document.getElementById('number_format_chart_institucion'));
	         chart.draw(data, options);

	         document.getElementById('format-select').onchange = function() {
	           options['vAxis']['format'] = this.value;
	           chart.draw(data, options);
	         };
	      };  
      
    </script>

    <script type="text/javascript">
        google.charts.load('current', {packages:['corechart']});
        google.charts.setOnLoadCallback(drawStuff);

          function drawStuff() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Cadena SIPOC');
            data.addColumn('number', 'Propuestas');
            data.addRows([

              @foreach($propuestas_solucion_institucion as $propuestas_solucion_institucion)
                  ['{{ $propuestas_solucion_institucion ->siglas_institucion }}',{{ $propuestas_solucion_institucion ->total}}],  
                @endforeach
            ]);

           var options = {
             title: 'Propuestas por Institución',
             width: 900,
             height: 300,
             legend: 'none',
             bar: {groupWidth: '95%'},
             vAxis: { gridlines: { count: 4 } }
           };

           var chart = new google.visualization.ColumnChart(document.getElementById('number_format_chart_solucion_institucion'));
           chart.draw(data, options);

           document.getElementById('format-select').onchange = function() {
             options['vAxis']['format'] = this.value;
             chart.draw(data, options);
           };
        };  
      
    </script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          @foreach($verbo_solucion as $verbo_solucions)
      	    ['{{ $verbo_solucions ->verbo_solucion }}',{{ $verbo_solucions ->total}}],  
      	  @endforeach
          
        ]);

        var options = {
          title: 'PROPUESTA POR TEMÁTICA'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_verbo'));

        chart.draw(data, options);
      }
    </script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          @foreach($propuestas_estado as $propuestas_estados)
      	    ['{{ $propuestas_estados ->nombre_estado }}',{{ $propuestas_estados ->total}}],  
      	  @endforeach
          
        ]);

        var options = {
          title: 'PROPUESTAS POR ESTADO'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_estado'));

        chart.draw(data, options);
      }
    </script>

  


    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          @foreach($propuestas_provincia as $propuestas_provincia)
      	    ['{{ $propuestas_provincia ->nombre_provincia }}',{{ $propuestas_provincia ->total}}],  
      	  @endforeach
        ]);

        var options = {
          title: 'NÚMERO DE PROPUESTAS POR PROVINCIA',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart_provincia'));
        chart.draw(data, options);
      }
    </script>


@endsection

@section('contenido')

	<!-- begin row -->
	<div id="about" class="content work" data-scrollview="true">
		<div class="container" data-animation="true" data-animation-type="fadeInDown">


        <div class="toolbar title_ip_breadcrumb fit-m-b-10">
          <ol class="breadcrumb">

            <li class="home"><a href="{{ url('/') }}"><i class="fa fa-home fa-lg"></i><span></span></a></li>
            <li class="active"><a href="{{ url('/busquedaAvanzada') }}">Resultados de la B&uacute;squeda</a> Díalogo Nacional</li>

          </ol>
        </div><hr style="margin-top:-10px;">
		<div class="row">
			
			<div class="col-md-12">

			<!-- inicio cuadrados -->
		
				<div class="col-md-12">

					<div class="row">
	                <div class="col-md-12">
	                    <div class="panel panel-inverse" data-sortable-id="chart-js-2">
                          <div class="panel-heading">
                            <h4 class="panel-title">ACTIVIDADES REGISTRADAS PROPUESTAS POR INSTITUCIÓN</h4>
                          </div>
	                        <div class="panel-body">
                            <div>
                            	<div id="number_format_chart_institucion"></div>
                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>

            <!-- begin row -->
            <div class="row">
                  <div class="col-md-12">
                      <div class="panel panel-inverse" data-sortable-id="chart-js-2">
                          <div class="panel-heading">
                            <h4 class="panel-title">PROPUESTAS POR INSTITUCIÓN</h4>
                          </div>
                          <div class="panel-body">
                            <div>
                              <div id="number_format_chart_solucion_institucion"></div>
                            </div>
                          </div>
                      </div>
                  </div>
              </div>
            <!-- end row -->
		        <!-- begin row -->
            <div class="row">
                <!-- begin col-6 -->
                <div class="col-md-6">
                    <div class="panel panel-inverse" data-sortable-id="flot-chart-3">
                        <div class="panel-heading">
                            <h4 class="panel-title">NÚMERO DE LAS PROPUESTAS POR ESTADO</h4>
                        </div>
                        <div class="panel-body">
                            <div>
                            	<div id="piechart_estado" style="width: 600px; height: 400px;"></div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col-6 -->
                <!-- begin col-6 -->
                <div class="col-md-6">
                    <div class="panel panel-inverse" data-sortable-id="flot-chart-3">
                        <div class="panel-heading">
                            <h4 class="panel-title">NÚMERO DE PROPUESTAS POR AMBITO</h4>
                        </div>
                        <div class="panel-body">
                            <div>
                                
                                <div id="donutchart_provincia"  style="width: 600px; height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col-6 -->
            </div>
            <!-- end row -->

            
				
				</div>
				<!-- Final cuadrados -->

			<!-- Inicio col-8 tabla -->
				
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

	

@endsection
