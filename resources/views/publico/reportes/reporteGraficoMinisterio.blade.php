@extends('layouts.institucion')
@section('title', 'Reporte Institucion')
@section('start_css')
  @parent
  	<link href="{{ asset('plugins/DataTablesv2/datatables.css') }}" rel="stylesheet" />
	<link href="{{ asset('css/style-after.css') }}" rel="stylesheet" />

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          @foreach($propuestas_estado as $propuestas_estados)
      	    ['{{ $propuestas_estados ->nombre_estado }}',{{ $propuestas_estados ->totalEstado}}],  
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
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          @foreach($tipoPropuestaInst as $tipoPropuestaInsts)
            ['{{ $tipoPropuestaInsts ->nombre_estado }}',{{ $tipoPropuestaInsts ->total}}],  
          @endforeach
          
        ]);

        var options = {
          title: 'Propuesta Institución'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_tipoPropuestaInst'));

        chart.draw(data, options);
      }
    </script>

   <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          @foreach($formaCumplimiento as $formaCumplimientos)
            ['{{ $formaCumplimientos ->nombre_propuesta }}',{{ $formaCumplimientos ->propuesta}}],  
          @endforeach
          
        ]);

        var options = {
          title: 'Forma de cumplimiento institución'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_formaCumplimiento'));

        chart.draw(data, options);
      }
    </script>
  


    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          @foreach($propuestasPlazo as $propuestasPlazos)
      	    ['{{ $propuestasPlazos ->plazo_cumplimiento }}',{{ $propuestasPlazos ->total}}],  
      	  @endforeach
        ]);

        var options = {
          title: 'NÚMERO DE PROPUESTAS POR PLAZO',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart_plazo'));
        chart.draw(data, options);
      }
    </script>
 <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);
     
  
      function drawStuff() {


        var data = google.visualization.arrayToDataTable([
          ['Institucion', 'N° de Propuestas Recibidas','N° de Propuestas Desestimadas','N° de Propuestas Validadas'],
          @foreach($propuestasPorTipo as $propuestasPorTipos)
            ['{{ $propuestasPorTipos->inst }}', {{ $propuestasPorTipos->recibidas}}, {{ $propuestasPorTipos->desestimadas}}, 
            {{ $propuestasPorTipos->validadas}}],  
          @endforeach
          
        ]);

        
        var options = {
          chart: {
            title: 'Tipo de propuesta',
            subtitle: 'Estado propuestas por institucion',
            vAxis: {
              minValue: 0,
              maxValue: 7,
              direction: 1,
              gridlines: {count: 8}
            }, 
            hAxis: {
            slantedTextAngle: 70,
            maxTextLines: 100,
            textStyle: {

              fontSize: 6,
              } // or the number you want}
          },    
          }
           

        };
        
        var chart = new google.charts.Bar(document.getElementById('barChart_tipoPropuesta'));
        
        chart.draw(data, google.charts.Bar.convertOptions(options));        

      }
    </script>    


@endsection
@section('content')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

<div class="container" width="100%">
 <div class="col-md-12 ">
  <div class="panel panel-default">
		<div class="row">
			
			<div class="col-md-12">

			<!-- inicio cuadrados -->
		
				<div class="col-md-12">

  <div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse"  data-sortable-id="chart-js-2">
            <div class="panel-heading">                
                 <h3 class="panel-title">Reporte Institucional de la Plataforma de Di&aacute;logo Nacional</h3>
            </div>
        </div>
    </div>
</div> 

 <div class="row">
  <table class="table table-hover">
                       
                        <tbody>

                     
                       <tr>
                           <th colspan="3" ><div align="center">Datos Informativos</div></th>
                        </tr>
                       
                         <tr>
                           <th colspan="2" ><div align="left">Fecha</div></th>
                            <td colspan="1" ><div align="left">{{$hoy}}</div></td>
                        </tr>
                         <tr>
                           <th colspan="2" ><div align="left">Responsable</div></th>
                            <td colspan="1" ><div align="left">{{$nombreusuario}}</div></td>
                        </tr>

                         <tr>
                           <th colspan="2" ><div align="left">Nombre de la Instituci&oacute;n</div></th>
                            <td colspan="1" ><div align="left">{{$nombreinstitucion}}</div></td>
                        </tr>

                          <tr>
                           <th colspan="2" ><div align="left">Consejo Sectorial</div></th>
                            <td colspan="1" ><div align="left">{{$nombreConsejo}}</div></td>
                        </tr>                        

                        </tbody>
    </table>

    </div>

  <br/><br/>

              <!--<form target="_self" method="GET" action="{{ route('reporteGraficoInstitucion.institucion') }}">
                   <div class="col-md-2">
                             Fecha Inicial
                   </div>
                   <div class="col-md-4">
                       
                       <input id="fechaInicial" name="fechaInicial" class="date form-control" type="text" value="{{$fechaInicial}}" required="" >
                   </div>
                   <div class="col-md-2">
                             Fecha Final
                   </div>
                   <div class="col-md-4">
                       
                       <input id="fechaFinal" name="fechaFinal" class="date form-control" type="text" value="{{$fechaFinal}}" required="" >
                   </div>
                   <div class="col-md-12">
                        <button type="submit"   class="btn btn-primary" name="consulto" value="{{$consulto='si'}}">Consultar</button>
                   </div>

                   <script type="text/javascript">
                      $('.date').datepicker({  
                         isRTL: false,
                         format: 'dd-mm-yyyy',
                          autoclose:true,
                          language: 'es'
                       });  

                   </script> 
               </form>-->
					<div class="row">
         
                  <div class="col-md-6">
                      <div class="panel panel-inverse" data-sortable-id="chart-js-2">
                          <div class="panel-heading">
                            <h4 class="panel-title">TIPO DE PROPUESTA</h4>
                          </div>
                          <div class="panel-body">
                            <div>
                              <div id="barChart_tipoPropuesta" style="width: 400px; height: 400px;"></div>
                            </div>
                          </div>
                      </div>
                  </div>
            
              
	             
                   <div class="col-md-6">
                    <div class="panel panel-inverse" data-sortable-id="flot-chart-3">
                        <div class="panel-heading">
                            <h4 class="panel-title">ESTADO DE LA PROPUESTA</h4>
                        </div>
                        <div class="panel-body">
                            <div>
                              <div id="piechart_tipoPropuestaInst" style="width: 500px; height: 400px;"></div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                               
	            </div>

   
		        <!-- begin row -->
            <div class="row">
 

            <div class="col-md-6">
                    <div class="panel panel-inverse" data-sortable-id="flot-chart-3">
                        <div class="panel-heading">
                            <h4 class="panel-title">FORMA DE CUMPLIMIENTO</h4>
                        </div>
                        <div class="panel-body">
                            <div>
                              <div id="piechart_formaCumplimiento" style="width: 500px; height: 400px;"></div>
                                
                            </div>
                        </div>
                    </div>
                </div>    



                <!-- begin col-6 -->
                <div class="col-md-6">
                    <div class="panel panel-inverse" data-sortable-id="flot-chart-3">
                        <div class="panel-heading">
                            <h4 class="panel-title">NÚMERO DE PROPUESTAS POR PLAZO</h4>
                        </div>
                        <div class="panel-body">
                            <div>
                                
                                <div id="donutchart_plazo"  style="width: 500px; height: 400px;"></div>
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
