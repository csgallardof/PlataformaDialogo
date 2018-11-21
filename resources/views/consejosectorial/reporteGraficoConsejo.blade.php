@extends('layouts.consejo-sectorial')
@section('title','Reporte Consejo Sectorial')
@section('start_css')
@parent
    <link href="{{ asset('plugins/DataTablesv2/datatables.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style-after.css') }}" rel="stylesheet" />
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

  <!-- <script type="text/javascript">
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
            subtitle: 'Estado propuestas por institucion'



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
    </script>-->

  <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart','bar']});
      google.charts.setOnLoadCallback(drawAxisTickColors);
     
  
      function drawAxisTickColors() {


        var data = google.visualization.arrayToDataTable([
          ['Institucion', 'N° de Propuestas Recibidas','N° de Propuestas Desestimadas','N° de Propuestas Validadas'],
          @foreach($propuestasPorTipo as $propuestasPorTipos)
            ['{{ $propuestasPorTipos->inst }}', {{ $propuestasPorTipos->recibidas}}, {{ $propuestasPorTipos->desestimadas}}, 
            {{ $propuestasPorTipos->validadas}}],  
          @endforeach
          
        ]);


     var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2,{ calc: "stringify",
                         sourceColumn: 2,
                         type: "string",
                         role: "annotation" }, 3,
                         { calc: "stringify",
                         sourceColumn: 3,
                         type: "string",
                         role: "annotation" }]);


        
        var options = {
          chart: {
            title: 'Propuestas por consejo sectorial',
            subtitle: 'Estado propuestas por institucion',
            bar: {groupWidth: "95%"},
            legend: { position: "none" },

            hAxis: {
              title: 'Total Population',
              minValue: 0,
              textStyle: {
                bold: true,
                fontSize: 4,
                color: '#4d4d4d'
              },
              titleTextStyle: {
                bold: true,
                fontSize: 8,
                color: '#4d4d4d'
              }
          },

          vAxis: {
          title: 'City',
          textStyle: {
            fontSize: 4,
            bold: true,
            color: '#848484'
          },
          titleTextStyle: {
            fontSize: 8,
            bold: true,
            color: '#848484'
          }

          }
           
              }
        };
        
        var chart = new google.visualization.BarChart(document.getElementById('barChart_tipoPropuesta'));
        chart.draw(view,options);        

      }
    </script>    

   <!--<script type="text/javascript">
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
    </script>-->    

  <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart','bar']});
      google.charts.setOnLoadCallback(drawAxisTickColors);
     
  
      function drawAxisTickColors() {


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
            subtitle: 'Estado propuestas por institucion',
            chartArea: {width: '50%'},

            hAxis: {
              title: 'Total Population',
              minValue: 0,
              textStyle: {
                bold: true,
                fontSize: 4,
                color: '#4d4d4d'
              },
              titleTextStyle: {
                bold: true,
                fontSize: 8,
                color: '#4d4d4d'
              }
          },

          vAxis: {
          title: 'City',
          textStyle: {
            fontSize: 4,
            bold: true,
            color: '#848484'
          },
          titleTextStyle: {
            fontSize: 8,
            bold: true,
            color: '#848484'
          }

          }
           
              }
        };
        
        var chart = new google.visualization.BarChart(document.getElementById('barChart_estadoPropuesta'));
        chart.draw(data,options);        

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


<div class="container">
 <!--<div class="col-md-12 ">-->
 <div class="panel panel-default">
 <div class="panel-body">
    <!-- inicio cuadrados -->
    
   

      <div class="row">
        <div class="col-md-12" style="margin-top:-40px;">
          <!-- begin panel -->
          <div class="panel panel-inverse">
            <div class="panel-heading">                
             <h3 class="panel-title" style="text-align: center;">Reporte Consejo Sectorial de la Plataforma de Di&aacute;logo Nacional</h3>
           </div>
         </div>
       </div>
     </div> 

     <div class="row">
       <div class="col-md-12">
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
   </div>
   <div class="row">

    <div class="col-md-12" style="margin-bottom: -120px;" >
      <div class="panel panel-inverse">
        <div class="panel-heading">
          <h4 class="panel-title">PROPUESTA POR TIPO</h4>
        </div>                      

        <div id="barChart_tipoPropuesta" style="width: 80% !important; height: 600px;"></div> 
      </div>
    </div>

  </div>
  <div class="row">
   <div class="col-md-12" style="margin-bottom: -120px;">
    <div class="panel panel-inverse">
      <div class="panel-heading">
        <h4 class="panel-title">PROPUESTA POR ESTADO</h4>
      </div>
      <div id="barChart_estadoPropuesta" style="width: 80% !important; height: 500px;"></div>                                

    </div>
  </div>
</div>  

<div class="row">   
  <div class="col-md-12" style="margin-bottom: -50px;">
    <div class="panel panel-inverse">
      <div class="panel-heading">
        <h4 class="panel-title">PROPUESTA TIEMPO</h4>
      </div>

      <div id="barChart_tiempoPropuesta" style="width: 800px; height: 200px;"></div>                                

    </div>
  </div>
</div>                               



<!-- begin row -->
<div class="row">
<div class="col-md-12" style="margin-bottom: -50px;">
 <div class="panel panel-inverse">
  <div class="panel-heading">
    <h4 class="panel-title">FORMA DE CUMPLIMIENTO</h4>
  </div>
</div>
<!-- begin col-6 -->
<div class="col-md-6">

  <div class="panel panel-inverse">
   <div id="piechart_politicaPublica" style="width: 500px; height: 300px;"></div>     
  </div>
</div>
<!-- end col-6 -->
<!-- begin col-6 -->
<div class="col-md-6">
  <div class="panel panel-inverse">
       <div id="piechart_leyes" style="width: 500px; height: 300px;"></div>
 </div>
</div>
<!-- end col-6 -->
</div>
</div>        

<div class="row">
 <div class="panel panel-inverse">
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
<div class="col-md-6" style="margin-bottom: -70px; margin-top: -60px;">

  <div class="panel panel-inverse">

    <div class="panel-body">
      <div>
        <div id="donutchart_mesasProvincia" style="width: 500px; height: 400px;"></div>

      </div>
    </div>
  </div>
</div>
<!-- end col-6 -->
<!-- begin col-6 -->
<div class="col-md-6" style="margin-bottom: -70px;  margin-top: -60px;">
  <div class="panel panel-inverse">

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
                                                                                                                                                                               
