@extends('layouts.main')
@section('title', 'Reporte')
@section('start_css')
@parent
<link href="{{ asset('plugins/DataTablesv2/datatables.css') }}" rel="stylesheet" />
<link href="{{ asset('css/style-after.css') }}" rel="stylesheet" />

@endsection

@section('contenido')
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      google.charts.setOnLoadCallback(drawChartMesa);
      google.charts.setOnLoadCallback(drawChartPlazo);
      google.charts.setOnLoadCallback(drawChartZona);
      google.charts.setOnLoadCallback(drawChartInstitucion);
      google.charts.setOnLoadCallback(drawChartActividad);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Propuestas por estados', 'Total'],
           @foreach($solicitud as $solicitudes)
           ['{{$solicitudes->estados}}',{{$solicitudes->total}}],
           @endforeach
        ]);
        var options = {
          title: 'Propuestas'
        };
        var chart = new google.visualization.PieChart(document.getElementById('estadosDiv'));
        chart.draw(data, options);
      }
      function drawChartMesa() {
        var data = google.visualization.arrayToDataTable([
          ['Propuestas por mesas y estado', 'Total'],
           @foreach($mesa as $mesas)
           ['{{$mesas->estados}}',{{$mesas->total}}],
           @endforeach
        ]);
        var options = {
          title: 'Mesas'
        };
        var chart = new google.visualization.PieChart(document.getElementById('mesasDiv'));
        chart.draw(data, options);
      }
      function drawChartZona() {
        var data = google.visualization.arrayToDataTable([
          ['Propuestas por zonas y estado', 'Total'],
           @foreach($zona as $zonas)
           ['{{$zonas->zonas}}',{{$zonas->total}}],
           @endforeach
        ]);
        var options = {
          title: 'Zonas'
        };
        var chart = new google.visualization.PieChart(document.getElementById('zonasDiv'));
        chart.draw(data, options);
      }
      function drawChartPlazo() {
        var data = google.visualization.arrayToDataTable([
          ['Propuestas por plzo y estado', 'Total'],
           @foreach($plazo as $plazos)
           ['{{$plazos->plazo}}',{{$plazos->total}}],
           @endforeach
        ]);
        var options = {
          title: 'Plazo'
        };
        var chart = new google.visualization.PieChart(document.getElementById('plazosDiv'));
        chart.draw(data, options);
      }
      function drawChartInstitucion() {
        var data = google.visualization.arrayToDataTable([
          ['Propuestas por instituciones', 'Total'],
           @foreach($institucion as $instituciones)
           ['{{$instituciones->instituciones}}',{{$instituciones->total}}],
           @endforeach
        ]);
        var options = {
          title: 'Instituciones'
        };
        var chart = new google.visualization.PieChart(document.getElementById('institucionesDiv'));
        chart.draw(data, options);
      }
      function drawChartActividad() {
        var data = google.visualization.arrayToDataTable([
          ['Propuestas por instituciones', 'Total'],
           @foreach($actividad as $actividades)
           ['{{$actividades->instituciones}}',{{$actividades->total}}],
           @endforeach
        ]);
        var options = {
          title: 'Instituciones'
        };
        var chart = new google.visualization.PieChart(document.getElementById('actividadesDiv'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
      <table>
          <tr>
              <td><div id="estadosDiv" style="width: 500px; height: 500px;"></div></td>
              <td><div id="mesasDiv" style="width: 500px; height: 500px;"></div></td>
          </tr>
<tr>
              <td><div id="zonasDiv" style="width: 500px; height: 500px;"></div></td>
              <td><div id="plazosDiv" style="width: 500px; height: 500px;"></div></td>
          </tr>
<tr>
              <td><div id="institucionesDiv" style="width: 500px; height: 500px;"></div></td>
              <td><div id="actividadesDiv" style="width: 500px; height: 500px;"></div></td>
          </tr>
            
    
  </body>
</html>

@endsection
