@extends('layouts.main')
@section('title', 'Reporte')
@section('start_css')
@parent
<link href="{{ asset('plugins/DataTablesv2/datatables.css') }}" rel="stylesheet" />
<link href="{{ asset('css/style-after.css') }}" rel="stylesheet" />

@endsection

@section('contenido')
 
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart','bar','table']});
      google.charts.setOnLoadCallback(drawChart);
      google.charts.setOnLoadCallback(drawChartMesa);
      google.charts.setOnLoadCallback(drawChartPlazo);
      google.charts.setOnLoadCallback(drawChartZona);
      google.charts.setOnLoadCallback(drawChartInstitucion);
      google.charts.setOnLoadCallback(drawChartActividad);
       google.charts.setOnLoadCallback(drawTable);


      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Consejo Sectorial', 'Analisis','Desarrollo', 'Finalizado'],
           @foreach($solicitud as $solicitudes)
           ['{{$solicitudes->nombre}}',{{$solicitudes->analisis}},{{$solicitudes->desarrollo}},{{$solicitudes->finalizado}}],
           @endforeach
        ]);
         var options = {
          chart: {
            title: 'Propuestas por Consejo Sectorial',
            subtitle: 'Estados de propuestas Analisis, Desarrollo, Finalizdo',
          }
        };

        //var chart = new google.visualization.PieChart(document.getElementById('estadosDiv'));
        //chart.draw(data, options);
        
        var chart = new google.charts.Bar(document.getElementById('estadosDiv'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
        
      }
      
      function drawChartMesa() {
        var data = google.visualization.arrayToDataTable([
          ['Mesa Dialogo', 'Analisis','Desarrollo', 'Finalizado'],
           @foreach($mesa as $mesas)
            ['{{$mesas->nombre}}',{{$mesas->analisis}},{{$mesas->desarrollo}},{{$mesas->finalizado}}],
           @endforeach
        ]);
      
         var options = {
          chart: {
            title: 'Mesas de dialogo',
            subtitle: 'Estados de propuestas Analisis, Desarrollo, Finalizdo',
          }
        };
        
        var chart = new google.charts.Bar(document.getElementById('mesasDiv'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
        
      }
      
      
      
      
      function drawChartZona() {
        var data = google.visualization.arrayToDataTable([
          ['Mesa Dialogo', 'Analisis','Desarrollo', 'Finalizado'],
           @foreach($zona as $zonas)
           ['{{$zonas->nombre}}',{{$zonas->analisis}},{{$zonas->desarrollo}},{{$zonas->finalizado}}],
           @endforeach
        ]);
        var options = {
          chart: {
            title: 'Zonas',
            subtitle: 'Estados de propuestas Analisis, Desarrollo, Finalizdo',
          }
        };
        
        var chart = new google.charts.Bar(document.getElementById('zonasDiv'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
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
      ['Instituciones', 'Analisis','Desarrollo', 'Finalizado'],
           @foreach($institucion as $instituciones)
             ['{{$instituciones->nombre}}',{{$instituciones->analisis}},{{$instituciones->desarrollo}},{{$instituciones->finalizado}}],
           @endforeach
        ]);
              var options = {
          chart: {
            title: 'Instituciones',
            subtitle: 'Estados de propuestas Analisis, Desarrollo, Finalizdo',
          }
        };
                var chart = new google.charts.Bar(document.getElementById('institucionesDiv'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
 
        function drawChartActividad() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Consejo Sectorial');
        data.addColumn('string', 'Institucion');
        data.addColumn('number', 'Analisis');
        data.addColumn('number', 'Desarrollo');
        data.addColumn('number', 'Finalizado');
        data.addColumn('number', 'Actividades');
        
        data.addRows([
        
          @foreach($actividad as $actividades)
          ['{{$actividades->consejo}}','{{$actividades->institucion}}',{{$actividades->analisis}},{{$actividades->desarrollo}},{{$actividades->finalizado}},{{$actividades->actividad}}],
           @endforeach
          
          
        ]);

        var table = new google.visualization.Table(document.getElementById('actividadesDiv'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
      }

    </script>
    <div class="container" >
        <div class="content" style="margin-top: 50px">
            <div class="title2">    
                <h3>Reporte de Propuestas</h3>  </div>
            <div class="row col-sm-12">
                <form method="POST"  action="/reporte">
                    {{ csrf_field() }}
                    <div class="form-group col-sm-4">
                        <label for="consejoSectorial_id">CONSEJO SECTORIAL:</label>
                         <select class="form-control" name="consejoSectorial_id" id="consejoSectorial_id">
                                    <option value="-1" selected="true"> - Seleccione - </option>
                                    @if( isset($consejoSectorial_) )
                                    @foreach( $consejoSectorial_ as $item )
                                    <option value="{{ $item->id}}">
                                        {{ $item->nombre_consejo}}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="estado_id">ESTADOS:</label>
                 
                         <select class="form-control" name="estado_id" id="estado_id">
                                    <option value="-1" selected="true"> - Seleccione - </option>
                                    @if( isset($estado_) )
                                    @foreach( $estado_ as $item )
                                    <option value="{{ $item->id}}">
                                        {{ $item->nombre_estado}}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                    </div>
                     <div class="form-group col-sm-4">
                        <label for="institucion_id">INSTITUCION:</label>
                        <select class="form-control" name="institucion_id" id="institucion_id">
                                    <option value="-1" selected="true"> - Seleccione - </option>
                                    @if( isset($institucion_) )
                                    @foreach( $institucion_ as $item )
                                    <option value="{{ $item->id}}">
                                        {{ $item->nombre_institucion}}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                    </div> 
                       <div class="form-group col-sm-4">
                        <label for="mesa_id">MESA:</label>
                        <select class="form-control" name="mesa_id" id="mesa_id">
                                    <option value="-1" selected="true"> - Seleccione - </option>
                                    @if( isset($mesaDialogo_) )
                                    @foreach( $mesaDialogo_ as $item )
                                    <option value="{{ $item->id}}">
                                        {{ $item->nombre}}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                    </div> 
                       <div class="form-group col-sm-4">
                        <label for="zona_id">ZONA:</label>
                        <select class="form-control" name="zona_id" id="zona_id">
                                     <option value="-1" selected="true"> - Seleccione - </option>
                                    @if( isset($zona_) )
                                    @foreach( $zona_ as $item )
                                    <option value="{{ $item->id}}">
                                        {{ $item->nombre}}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                    </div> 
                      <div class="form-group col-sm-4">
                        <label for="palabra_clave">PALABRA CLAVE:</label>
                        <input type="text" class="form-control" id="palabra_clave" name="palabra_clave">
                    </div> 
                    <button type="submit" class="btn btn-default">Buscar...</button>
                </form> 
            </div>
 

            <div class="row col-sm-12">

                <div id="estadosDiv" style="width: 400px; height: 400px;" class=" col-sm-6"></div>
                <div id="mesasDiv" style="width: 400px; height: 400px;" class=" col-sm-6"></div>
            </div>
            <div class="row col-sm-12">
                <div id="zonasDiv" style="width: 400px; height: 400px;" class=" col-sm-6"></div>
                <div id="plazosDiv" style="width: 400px; height: 400px;"class=" col-sm-6"></div>
            </div>
            <div class="row col-sm-12">
                <div id="institucionesDiv" style="width: 400px; height: 400px;"class=" col-sm-6"></div>
           
            </div>
             <div class="row col-sm-12">
     
                <div id="actividadesDiv"  class=" col-sm-12"></div>
            </div>
        </div>
    </div>
    
     
     @endsection
