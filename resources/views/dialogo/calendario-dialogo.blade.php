
@extends('layouts.main')

@section('title', 'Inicio')

@section('start_css')
  @parent
  <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
  
  <link href="{{asset('plugins/fullcalendar/fullcalendar/fullcalendar.css')}}" rel="stylesheet" />
  <!-- ================== END PAGE LEVEL STYLE ================== -->
  
@endsection

@section('contenido')
          
        <!-- begin #about -->
        <div id="about"  data-scrollview="true"  > <!--class="content work row-m-t-3 p-t-40" -- >
            <!-- begin container -->
            <!--<div class="container p-t-25" data-animation="true" data-animation-type="fadeInDown" >-->
              <div class="container p-t-25" data-animation="true" data-animation-type="fadeInDown" style="  width: 98%">
                <div  ><!--class="col-md-12 p-t-25" -->
                  <div style=" text-align: justify;">
                    <!--<div class="panel-body">-->
                        <h2 class="text-center"><strong>CALENDARIO DEL DIALOGO</strong></h2>

                            <div class="section_table">
                               <div class="section_row">
                                 <div class="section_cell2">
                         <p >
                          <h3><b>OBJETIVOS DE LA SEGUNDA FASE DEL DIALOGO</b></h3>
<h3><b>Objetivo general:</b></h3>

Desarrollar 16.171 espacios de diálogo en el territorio nacional, mismos que contarán con la participación de Delegados Zonales, Jefes y Tenientes políticos, actores sociales y la ciudadanía en general, con la finalidad de instaurar una cultura de diálogo territorial, que garantice cercanía del Estado con los ciudadanos, la cual permite promover la participación social, con el fin de generar acuerdos en la construcción de políticas, programas, proyectos y otros instrumentos que mejoren la gobernanza y gobernabilidad.

<h3><b>Objetivos Específicos:</b></h3>

a)  Consolidar la gobernanza y gobernabilidad nacional, como un espacio de construcción de sujetos de expresión ciudadana.


b)  Informar a la ciudadanía sobre los logros y acciones del Gobierno frente a las preocupaciones territoriales para fortalecer la gestión gubernamental.

c)  Identificar los requerimientos, problemas y propuestas ciudadanas para canalizarlas a los ámbitos correspondientes
d)  Activar a la ciudadanía como gestora de cambio social.
</p>                        
                                </div>
                                <div class="section_cell">
                                    <!--Columna 2 -->
                                    <table >
                                       <tr>
                                        <td style="text-align: center;background-color: #193b68;color: white; font-weight: bold;">
                                          #Dialoguemos
                                        </td>
                                       </tr>

                                       <tr>
                                        <td style="text-align: center;background-color: #193b68;color: white; font-weight: bold;">
                                          #TuVozEsMiVoz
                                        </td>
                                       </tr>

                                       <tr>
                                        <td style="background-color: #C6D9F1; font-weight: bold;color: black;padding: 10px;">
                                         24 provincias (2 semanales - 8 mensuales) Especialistas T&eacutecnicos, Gobernadores, Jefes y Tenientes Pol&iacuteticos
                                        </td>
                                       </tr>

                                       <tr>
                                        <td><br>
                                        </td>
                                       </tr>
                                    
                                    </table>
                                    <table width="100%">

                                       <tr>
                                        <td style="text-align: center;background-color: #193b68;color: white; font-weight: bold;">
                                          Agosto
                                        </td>

                                        <td style="text-align: center;background-color: #193b68;color: white; font-weight: bold;">
                                          Septiembre
                                        </td>

                                        <td style="text-align: center;background-color: #193b68;color: white; font-weight: bold;">
                                          Noviembre
                                        </td>

                                        <td style="text-align: center;background-color: #193b68;color: white; font-weight: bold;">
                                          Diciembre
                                        </td>

                                       </tr>

                                       <tr>
                                        <td style="background-color: #C6D9F1; font-weight: bold;color: black;padding: 10px;">
                                         4.471 voceros
                                        </td>
                                        <td style="background-color: #C6D9F1; font-weight: bold;color: black;padding: 10px;">
                                         3.698 voceros
                                        </td>

                                        <td style="background-color: #C6D9F1; font-weight: bold;color: black;padding: 10px;">
                                         3.698 voceros
                                        </td>

                                        <td style="background-color: #C6D9F1; font-weight: bold;color: black;padding: 10px;">
                                         2.152 voceros
                                        </td>

                                       </tr>                                       

                                       <tr>
                                        <td colspan="4">
                                          <br>
                                        </td>
                                       </tr>

                                    </table>


                                      <table width="100%">
                                       <tr>
                                        <td style="text-align: center;background-color: #193b68;color: white; font-weight: bold;">
                                          CAPACITACI&OacuteN DE VOCER&IacuteA
                                        </td>
                                       </tr>

                                       <tr>
                                        <td style="text-align: center;background-color: #193b68;color: white; font-weight: bold;">
                                          AGENDA DE MEDIOS
                                        </td>
                                       </tr>

                                       <tr>
                                        <td style="background-color: #C6D9F1; font-weight: bold;color: black;text-align: center;padding: 10px;">
                                         Encuentro Nacional de Voceros 17 de Noviembre
                                        </td>
                                       </tr>
                                       <tr>
                                        <td style="background-color: #C6D9F1; font-weight: bold;color: black;text-align: center;padding: 10px;">
                                        16.171 VOCEROS(Red de Vocer&iacuteas)
                                        </td>
                                       </tr>


                                       <tr>
                                        <td><br>
                                        </td>
                                       </tr>
                                    
                                    </table>                                    
                                    <!--Fin de Columna 2 --> 
                                </div>
                           </div>  
                        </div>
                    </div>
                </div>

                <div class="content_cal">
                  <div class="panel-body p-0">
                    <div class="vertical-box">
                            
                        <div id="calendar" class="vertical-box-column p-15 calendar"></div>
                    </div>
                  </div>
              </div>
 
            </div>
        </div>

  

@endsection

@section('end_js')
  @parent

  
  <script src="{{ asset('plugins/fullcalendar/fullcalendar/fullcalendar.js') }}"></script>
  <script src="{{ asset('js/calendar.demo.js') }}"></script>
  <script src="{{ asset('js/apps.min.js') }}"></script>

    
  
@endsection

@section('init_scripts')

  <script>
      var date = new Date();
  var m = date.getMonth();
  var y = date.getFullYear();

  <?php
    
    if(isset($eventos)){

      echo "data2=[";
        foreach ($eventos as $ev) {
          
          //$date = DateTime::createFromFormat("Y-m-d", $ev->created_at);

          $year= date('Y', strtotime( $ev->created_at));
          $month= date('m', strtotime( $ev->created_at))-1;//$date->format("m")-1;
          $day= date('d', strtotime( $ev->created_at));//$date->format("d");

          echo "    {
        title: '".$ev->nombre_evento."',
        start: new Date(".$year.",".$month." , ".$day.",),
        end: new Date(".$year.",".$month." , ".$day."),
        allDay: false,
        className: 'bg-blue',
        media: '',
        description: '".$ev->nombre_provincia."'
      },";
       

        }//end of foreach

        echo "];";

    }

  ?>
   console.log(data2);
   var data = [
    
      {
        title: 'Articulación Institucional',
        start: new Date(y,10 , 11,),
        end: new Date(y, 10 , 11),
        allDay: false,
        className: 'bg-blue',
        media: '<i class="fa fa-users"></i>',
        description: '- MAG <br> -MIPRO <br>, -DGAC.'
      },
      {
        title: 'Articulación Institucional',
        start: new Date(y,10 , 12,),
        end: new Date(y, 10 , 13),
        allDay: false,
        className: 'bg-blue',
        media: '<i class="fa fa-users"></i>',
        description: '- MTOP <br> -SRI <br>, -MDT.'
      },
      {
        title: 'Articulación Institucional',
        start: new Date(y,10 , 13,),
        end: new Date(y, 10 , 13),
        allDay: false,
        className: 'bg-blue',
        media: '<i class="fa fa-users"></i>',
        description: '- PROECUADOR <br> -MEER <br>, -SENAE.'
      },
      {
        title: 'Articulación Institucional',
        start: new Date(y,5 , 14,),
        end: new Date(y, 5 , 14),
        allDay: false,
        className: 'bg-blue',
        media: '<i class="fa fa-users"></i>',
        description: '- INEN <br> -MINTUR <br>, -MAP.'
      },
      {
        title: 'Articulación Institucional',
        start: new Date(y,5 , 15,),
        end: new Date(y, 5 , 15),
        allDay: false,
        className: 'bg-blue',
        media: '<i class="fa fa-users"></i>',
        description: '- BANECUADOR <br> -AGROCALIDAD <br>, -SERCOP.'
      },

      {
        title: 'Articulación Institucional',
        start: new Date(y,5 , 18,),
        end: new Date(y, 5 , 18),
        allDay: false,
        className: 'bg-blue',
        media: '<i class="fa fa-users"></i>',
        description: '- MIENTE <br> -INMOBILIAR <br>, -ARCSA.'
      },
      {
        title: 'Articulación Institucional',
        start: new Date(y,5 , 19,),
        end: new Date(y, 5 , 19),
        allDay: false,
        className: 'bg-blue',
        media: '<i class="fa fa-users"></i>',
        description: '- IEPS <br> -MEF <br>, -CFN.'
      },
      {
        title: 'Articulación Institucional',
        start: new Date(y,5 , 20,),
        end: new Date(y, 5 , 20),
        allDay: false,
        className: 'bg-blue',
        media: '<i class="fa fa-users"></i>',
        description: '- MCEI'
      },
      

      
    ];

    $(document).ready(function() {

      App.init();
      Calendar.init(data2);
    });
  </script>

@endsection
