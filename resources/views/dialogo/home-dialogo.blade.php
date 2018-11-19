@extends('layouts.main')

@section('title', 'Inicio')

@section('start_css')
  @parent
@endsection

@section('contenido')

        <!-- begin #about -->
<section class="section_table_hm">   
<div id="backg">
   <div class="head_table">
       <div class="dvheader_logo"> 
         <img id="logo_home" src="{{ asset('imagenes/dialogo_nacional/nueva_imagen/dialogo_nacional.png') }}" width="190px" height="190px" alt="Logo Dialogo Nacional">
       </div>
        <!--  <div id="inp_busqueda_banner">
          </div>
        -->
      <div class="dvheader_busqueda">
         <!--<input type="text" name="txt_busqueda" value="" />-->
          <div class="head_table2">
            <div class="head_row2">

              <div class="head_cell"></div>
              <div class="head_cell">
                        <div id="searchwrapper">
                            <form role="form" method="GET"    action="/busquedaAvanzadaDialogoFiltro/"  >
                             {{ csrf_field() }}
                              <input type="hidden" name="selectBusqueda" id="selectBusqueda" value="si"/>
                                <label for="s" style="text-indent: -9999px;size: 0px;">Ingrese su texto para buscar en el sistema</label>
                                <input type="text" class="searchbox" name="s" id="s" value="" placeholder="Buscar" />
                                <input type="image" src="{{ asset('imagenes/dialogo_nacional/nueva_imagen/lupa.png') }}" class="searchbox_submit" value="" alt="Boton de busqueda" />
                            </form>
                        </div>
              </div>
              <div class="head_cell">&nbsp;</div>
             </div> <!-- end of row-->          

             


          </div>               
      </div>
   </div>   
</div><!-- end of row2-->

</section>

<nav>
 <div class="nav_rw">
 <h2> BUSQUEDA POR EJES DE ACCI&OacuteN</h2>
 </div>

  <div class="nav_rw2">
                   <?php

                    $path_derechos_img = 'imagenes/dialogo_nacional/nueva_imagen/ico_derechos.png';
                    $path_derechos_img_hover = 'imagenes/dialogo_nacional/nueva_imagen/ico_derechos_hover.png';

                    $path_economico = 'imagenes/dialogo_nacional/nueva_imagen/economico.png';
                    $path_economico_hover = 'imagenes/dialogo_nacional/nueva_imagen/economico_hover.png';

                    $path_transparencia = 'imagenes/dialogo_nacional/nueva_imagen/transparencia.png';
                    $path_transparencia_hover = 'imagenes/dialogo_nacional/nueva_imagen/transparencia_hover.png';

                   ?>

      <div >
          <a class="nav_button myButtonEje" href="/busqueda-ejes/1">
            
             <img id="menu_ico_not" src="{{ asset('imagenes/dialogo_nacional/nueva_imagen/ico_derechos.png') }}" width="30px" height="30px" alt="Logo en forma de mundo" onmouseover="this.src='{{ asset($path_derechos_img) }}'"
              onmouseout="this.src='{{ asset($path_derechos_img_hover) }}'" />

              Derechos
            
          </a>


          <a class="nav_button2 myButtonEje2" href="/busqueda-ejes/2">
            
             <img id="menu_ico_not" src="{{ asset('imagenes/dialogo_nacional/nueva_imagen/economico.png') }}" width="30px" height="30px" alt="Logo en forma de mundo" onmouseover="this.src='{{ asset($path_economico) }}'"
              onmouseout="this.src='{{ asset($path_economico_hover) }}'" />

              Econ&oacutemico
            
          </a>

          <a class="nav_button3 myButtonEje3" href="/busqueda-ejes/3">
            
             <img id="menu_ico_not" src="{{ asset('imagenes/dialogo_nacional/nueva_imagen/transparencia.png') }}" width="30px" height="30px" alt="Logo en forma de mundo" onmouseover="this.src='{{ asset($path_transparencia) }}'"
              onmouseout="this.src='{{ asset($path_transparencia_hover) }}'" />

              Transparencia
            
          </a>
      <div>  
 </div>
</nav>

<section class="section_table2">
<section class="section_row">
  <section class="section_content2">
<!--    -->
  <center><h2><span style="color:#035A77;font-size: 26px;font-weight: bold;">DIALOGO NACIONAL</span></h2></center>
   <div class="section_table">
       <div class="section_row">
               
        </div>   
        <div class="section_row">      
      <section class="section_cell">
       <p>
           El Gobierno del Ecuador estableci&oacute mediante el Decreto Ejecutivo N&deg49 el proceso del Di&aacutelogo Nacional, como pol&iacutetica prioritaria para el fortalecimiento de los espacios de participaci&oacuten ciudadana, el di&aacutelogo amplio y permanente con todos los sectores de la sociedad.
           La Secretar&iacutea Nacional de Gesti&oacuten de la Pol&iacutetica (SNGP), la Secretar&iacutea Nacional de Planificaci&oacuten y 
           Desarrollo (Senplades) y la Secretar&iacutea Nacional de 
           Comunicaci&oacuten (SECOM) lideraron un amplio proceso  

                   
       </p> 
      </section>

      <section class="section_cell">
       <p>
           di&aacutelogo con diferentes actores sociales.
           El Di&aacutelogo Nacional permiti&oacute ampliar un abanico de visiones y de retroalimentaci&oacuten de aportes en todos los niveles sociales posibles; generando un &aacutembito propicio para la creaci&oacuten e propuestas incluyentes, integradoras, sostenibles, enfocadas al consenso para lograr y consagrar los grandes objetivos nacionales de una manera participativa y democr&aacutetica.
                   
       </p> 
      </section>
    </div>

  
  </div> 
<!--   -->
 </section>


<div class="vl"></div>

<!--<section class="section_cell">
  &nbsp;
</section>-->

<section class="section_content">
   <div class="cls_mp_r2" >
      <!--<img id="mapa_r" src="{{ asset('imagenes/dialogo_nacional/nueva_imagen/mapa.png') }}" width="250px" height="250px" alt="Mapa eventos de mesas">-->

       <div id="container_map" data-highcharts-chart="0"></div>
    </div>
</section>

</section>  <!-- End of row of section -->

</section><!-- End of table section -->


<section class="section_row">
   <script src="{{ asset('js/map/highmaps.js') }}"></script>
   <script src="{{ asset('js/map/exporting.js') }}"></script>
   <script src="{{ asset('js/map/ec-all.js') }}"></script>
  <!--<script src="https://code.highcharts.com/maps/highmaps.js"></script>
 
  
  <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/mapdata/countries/ec/ec-all.js"></script>-->

 

  <!-- TODO: Missing CoffeeScript 2 -->

  <script type="text/javascript">

<?php
 if(isset($eventos)){
     echo "data_f=[";
    foreach ($eventos as $ev) {
        echo "['".$ev[0]."', ".$ev[1]."]";

        echo ",";

    }
    echo "];";

 }

 ?>


// Prepare demo data
// Data is joined to map using value of 'hc-key' property by default.
// See API docs for 'joinBy' for more info on linking data and map.

var data5 = [
    {name:'ec-gu', code: 'ec-gu', value:1}
];

var data3= [{
    value: 6,
    name: "ec-gu",
    color: "#00FF00"
}, {
    value: 6,
    name: "ec-es",
    color: "#FF00FF"
}];

var data = [
    ['ec-gu', 0],
    ['ec-es', 1],
    ['ec-cr', 2],
    ['ec-im', 3],
    ['ec-su', 4],
    ['ec-se', 5],
    ['ec-sd', 6],
    ['ec-az', 7],
    ['ec-eo', 8],
    ['ec-lj', 9],
    ['ec-zc', 10],
    ['ec-cn', 11],
    ['ec-bo', 12],
    ['ec-ct', 13],
    ['ec-lr', 14],
    ['ec-mn', 15],
    ['ec-cb', 16],
    ['ec-ms', 17],
    ['ec-pi', 18],
    ['ec-pa', 19],
    ['ec-1076', 20],
    ['ec-na', 21],
    ['ec-tu', 22],
    ['ec-ga', 23],
    ['undefined', 24]
];

// Create the chart
Highcharts.mapChart('container_map', {
    chart: {
        map: 'countries/ec/ec-all'
    },

    title: {
        text: 'Total de eventos por Provincia'
    },

    subtitle: {
        text: ''
    },

    mapNavigation: {
        enabled: true,
        buttonOptions: {
            verticalAlign: 'bottom'
        }
    },

    colorAxis: {
        min: 0
    },

    plotOptions: {
            series: {
                events: {
                    click: function (e) {
                        var text = '<b>Detalles</b><br>' + this.name +
                                '<br>Provincia: ' + e.point.name + ' ' + e.point.value + ' eventos '+'<br><a href="/calendario-dialogo-nacional">Ver Calendario</a>';
                        if (!this.chart.clickLabel) {
                            this.chart.clickLabel = this.chart.renderer.label(text, 0, 250)
                                .css({
                                    width: '180px'
                                })
                                .add();
                        } else {
                            this.chart.clickLabel.attr({
                                text: text
                            });
                        }
                    }
                }
            }
        },

    series: [{
        data: data_f,
        name: 'Eventos programados:',
        borderColor: 'black',
        borderWidth: 0.2,
        states: {
            hover: {
                color: '#BADA55'
            }
        },
        tooltip: {
                valueSuffix: ' eventos'
        },        
        dataLabels: {
            enabled: true,
            format: '{point.name}'
        }
    }, {
        name: 'Separators',
        type: 'mapline',
        data: Highcharts.geojson(Highcharts.maps['countries/ec/ec-all'], 'mapline'),
        color: 'silver',
        showInLegend: false,
        enableMouseTracking: false
    }]
});



</script>


</section>


@endsection

@section('end_js')
  @parent

<script type="text/javascript">


</script>
<script src="{{ asset('js/banner_switch.js') }}"></script>
  <script src="{{ asset('js/ui-modal-notification.demo.js') }}"></script>
@endsection

@section('init_scripts')

  <script>
      $(document).ready(function() {
          Notification.init();
      });
  </script>

@endsection
