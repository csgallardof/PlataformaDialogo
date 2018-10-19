@extends('layouts.main')

@section('title', 'Inicio')

@section('start_css')
  @parent
@endsection

@section('contenido')

        <!-- begin #about -->
<section class="section_table">   
<div id="backg">
   <div class="head_table">
       <div class="dvheader_logo"> 
         <img src="{{ asset('imagenes/dialogo_nacional/nueva_imagen/dialogo_nacional.png') }}" width="290px" height="290px" alt="Logo Dialogo Nacional">
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
                            <form action="">
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
          <a class="nav_button" href="#">
            
             <img id="menu_ico_not" src="{{ asset('imagenes/dialogo_nacional/nueva_imagen/ico_derechos.png') }}" width="30px" height="30px" alt="Logo en forma de mundo" onmouseover="this.src='{{ asset($path_derechos_img) }}'"
              onmouseout="this.src='{{ asset($path_derechos_img_hover) }}'" />

              Derechos
            
          </a>


          <a class="nav_button2" href="#">
            
             <img id="menu_ico_not" src="{{ asset('imagenes/dialogo_nacional/nueva_imagen/economico.png') }}" width="30px" height="30px" alt="Logo en forma de mundo" onmouseover="this.src='{{ asset($path_economico) }}'"
              onmouseout="this.src='{{ asset($path_economico_hover) }}'" />

              Econ&oacutemico
            
          </a>

          <a class="nav_button3" href="#">
            
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

<section class="section_cell">
  &nbsp;
</section>

<section class="section_content">
   <div style="width: 80%; margin: 0 auto;">
      <img  src="{{ asset('imagenes/dialogo_nacional/nueva_imagen/mapa.png') }}" width="250px" height="250px" alt="Mapa eventos de mesas">
    </div>
</section>

</section>  <!-- End of row of section -->

</section><!-- End of table section -->



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
