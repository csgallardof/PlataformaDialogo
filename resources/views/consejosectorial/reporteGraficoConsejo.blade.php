@extends('layouts.consejo-sectorial')
@section('title','Reporte Consejo Sectorial')
@section('start_css')
@parent
    <link href="{{ asset('plugins/DataTablesv2/datatables.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style-after.css') }}" rel="stylesheet" />
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

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
            title: 'Propuestas por consejo sectorial',
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

        //var my_div = document.getElementById('barChart_tipoPropuesta');
        //var my_chart = new google.visualization.ChartType(barChart_tipoPropuesta);

        // google.visualization.events.addListener(my_chart, 'ready', function () {
         //my_div.innerHTML = '<img src="' + my_chart.getImageURI() + '">';
        //});

        
        chart.draw(data, google.charts.Bar.convertOptions(options));        

      }
    </script>

   <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {


        var data = google.visualization.arrayToDataTable([
          ['Institucion', 'Finalizado','En Desarrollo','En Análisis','Desestimado','En Conflicto'],
          @foreach($propuestasPorEstado as $propuestasPorEstados)
            ['{{ $propuestasPorEstados->inst }}', {{ $propuestasPorEstados->finalizado}}, {{ $propuestasPorEstados->desarrollo}}, 
            {{ $propuestasPorEstados->analisis}}, {{$propuestasPorEstados->desestimadas}}, {{$propuestasPorEstados->conflicto}}],  
          @endforeach
          
        ]);

        
        var options = {
          chart: {
            title: 'Propuestas por consejo sectorial',
            subtitle: 'Estado propuestas por institucion'            
          }
           

        };
        
        var chart = new google.charts.Bar(document.getElementById('barChart_estadoPropuesta'));
        
        chart.draw(data, google.charts.Bar.convertOptions(options));        
      }
    </script>    

  <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawBarTiempo);

      function drawBarTiempo() {

        var data = google.visualization.arrayToDataTable([
          ['Institucion','Largo', 'Mediano','Corto'],
          @foreach($propuestasPorTiempo as $propuestasPorTiempos)
            ['{{ $propuestasPorTiempos->inst }}', {{ $propuestasPorTiempos->largo}}, {{ $propuestasPorTiempos->mediano}}, 
            {{$propuestasPorTiempos->corto}}],  
          @endforeach
          
        ]);

        
        var options = {
          chart: {
            title: 'Propuestas por consejo sectorial',
            subtitle: 'Estado propuestas por tiempo'            
          }
           

        };
        
        var chart = new google.charts.Bar(document.getElementById('barChart_tiempoPropuesta'));
        
        chart.draw(data, google.charts.Bar.convertOptions(options));        
      }
    </script>    

   <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Institucion', 'Politica Pública'],
          @foreach($propuestasPoliticaPublica as $propuestasPoliticaPublicas)
            ['{{ $propuestasPoliticaPublicas ->nombre_institucion }}',{{ $propuestasPoliticaPublicas ->politica}}],  
          @endforeach
          
        ]);

        var options = {
          title: 'PROPUESTAS POR POLITICA PUBLICA'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_politicaPublica'));

        chart.draw(data, options);
      }
    </script>    

   <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Institucion', 'Leyes'],
          @foreach($propuestasLey as $propuestasLeyes)
            ['{{ $propuestasLeyes ->nombre_institucion }}',{{ $propuestasLeyes ->leyes}}],  
          @endforeach
          
        ]);

        var options = {
          title: 'PROPUESTAS POR LEYES'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_leyes'));

        chart.draw(data, options);
      }
    </script>

       <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      //google.charts.load("current", {packages:["imagepiechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Provincia', 'N° de mesas'],
          @foreach($mesasProvinciaConsejo as $mesasProvinciaConsejos)
            ['{{ $mesasProvinciaConsejos ->nombre_provincia }}',{{ $mesasProvinciaConsejos ->mesas}}],  
          @endforeach
        ]);

        var options = {
          title: 'NÚMERO DE MESAS POR PROVINCIA',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart_mesasProvincia'));
        chart.draw(data, options);

        //var chart = new google.visualization.ImagePieChart(document.getElementById('donutchart_mesasProvincia'));
        //chart.draw(data, options);
      }
    </script>

       <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Ambito', 'total'],
          @foreach($propuestaPorAmbito as $propuestaPorAmbitos)
            ['{{ $propuestaPorAmbitos ->ambito }}',{{ $propuestaPorAmbitos ->numPorAmbito}}],  
          @endforeach
        ]);

        var options = {
          title: 'NÚMERO DE PROPUESTAS POR AMBITO',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart_propuestasAmbito'));
        chart.draw(data, options);
      }
    </script>    

@endsection  

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>


<div class="container" style="background-color: #f3f3f3;">
 <!--<div class="col-md-12 ">-->
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
                 <h3 class="panel-title">Reporte Consejo Sectorial de la Plataforma de Di&aacute;logo Nacional</h3>
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
     <div class="row">
       
      <div id="my_div" class="col-md-12">
                    <div class="panel panel-inverse" data-sortable-id="flot-chart-3">
                        <div class="panel-heading">
                            <h4 class="panel-title">PROPUESTA POR TIPO</h4>
                        </div>
                        <div class="panel-body">
                            <div>
                              <div id="barChart_tipoPropuesta" style="width: 900px; height: 300px;"></div>                                
                            </div>
                        </div>
                    </div>
                </div>
     </div>
            <div class="row">
                   <div class="col-md-12">
                    <div class="panel panel-inverse" data-sortable-id="flot-chart-3">
                        <div class="panel-heading">
                            <h4 class="panel-title">ESTADO PROPUESTA</h4>
                        </div>
                        <div class="panel-body">
                            <div>
                              <div id="barChart_estadoPropuesta" style="width: 900px; height: 300px;"></div>                                
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-md-12">
                    <div class="panel panel-inverse" data-sortable-id="flot-chart-3">
                        <div class="panel-heading">
                            <h4 class="panel-title">PROPUESTA TIEMPO</h4>
                        </div>
                        <div class="panel-body">
                            <div>
                              <div id="barChart_tiempoPropuesta" style="width: 800px; height: 200px;"></div>                                
                            </div>
                        </div>
                    </div>
                </div>                               
              </div>

        <!-- begin row -->
            <div class="row">
             <div class="panel panel-inverse"  data-sortable-id="chart-js-2">
            <div class="panel-heading">
                            <h4 class="panel-title">FORMA DE CUMPLIMIENTO</h4>
              </div>
              </div>
                <!-- begin col-6 -->
                <div class="col-md-6">

                    <div class="panel panel-inverse" data-sortable-id="flot-chart-3">
                        
                        <div class="panel-body">
                            <div>
                              <div id="piechart_politicaPublica" style="width: 500px; height: 300px;"></div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col-6 -->
                <!-- begin col-6 -->
                <div class="col-md-6">
                    <div class="panel panel-inverse" data-sortable-id="flot-chart-3">
                        
                        <div class="panel-body">
                            <div>
                               <div id="piechart_leyes" style="width: 500px; height: 300px;"></div>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col-6 -->
            </div>        

          <div class="row">
             <div class="panel panel-inverse"  data-sortable-id="chart-js-2">
            <div class="panel-heading">
                            <h4 class="panel-title">MESA DE DIALOGO</h4>
              </div>
              <table class="table table-hover">
                <tbody>                     
                 <tr>
                   <th colspan="2" ><div align="left">Consejo Sectorial</div></th>
                   <td colspan="1" ><div align="left">{{$mesasPorConsejo[0]->nombre_consejo}}</div></td>
                   <th colspan="2" ><div align="left">Propuestas en proceso</div></th>
                   <td colspan="1" ><div align="left">{{$mesasPorConsejo[0]->proceso}}</div></td>
                   <th colspan="2" ><div align="left">Propuestas finalizadas</div></th>
                   <td colspan="1" ><div align="left">{{$mesasPorConsejo[0]->finalizado}}</div></td>
                 </tr>
               </tbody>
             </table>              
              </div>
                <!-- begin col-6 -->
                <div class="col-md-6">

                    <div class="panel panel-inverse" data-sortable-id="flot-chart-3">
                        
                        <div class="panel-body">
                            <div>
                              <div id="donutchart_mesasProvincia" style="width: 500px; height: 400px;"></div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col-6 -->
                <!-- begin col-6 -->
                <div class="col-md-6">
                    <div class="panel panel-inverse" data-sortable-id="flot-chart-3">
                        
                        <div class="panel-body">
                            <div>
                               <div id="donutchart_propuestasAmbito" style="width: 500px; height: 400px;"></div>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col-6 -->
            </div>   

  <br/>

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
  <script>

    $(document).ready(function() {
      App.init();
      TablaCCPTHome.init();
    });

  </script>  

@endsection
                                                                                                                                                                               
