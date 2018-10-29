
                   <?php

                   	$path_home_img = 'imagenes/dialogo_nacional/nueva_imagen/home.png';
                   	$path_home_img_hover = 'imagenes/dialogo_nacional/nueva_imagen/home_hover.png';

   	                $path_megafono = 'imagenes/dialogo_nacional/nueva_imagen/megafono.png';
                   	$path_megafono_hover = 'imagenes/dialogo_nacional/nueva_imagen/megafono_hover.png';

   	                $path_mesas_ico = 'imagenes/dialogo_nacional/nueva_imagen/mesas_ico.png';
                   	$path_mesas_ico_hover = 'imagenes/dialogo_nacional/nueva_imagen/mesas_ico_hover.png';

   	                $path_noticias = 'imagenes/dialogo_nacional/nueva_imagen/noticias.png';
                   	$path_noticias_hover = 'imagenes/dialogo_nacional/nueva_imagen/noticias_hover.png';

   	                $path_login = 'imagenes/dialogo_nacional/nueva_imagen/login.png';
                   	$path_login_hover = 'imagenes/dialogo_nacional/nueva_imagen/login_hover.png';

                   ?>

<!-- begin #header -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="{{asset('js/jquery.min.js')}}"></script>

<script> // script for expand/collapse


$( document ).ready(function() {
    expandCollapse();
});


    var expandCollapse = function(){
        if ( $(window).width() < 800 ) {
            $(function(){

            	 var x = document.getElementById("sidebar");
            	 var ht = '';
            	 x.style.display = "block";


                 var div = document.createElement('div');

                 div.className = 'row';
                  
                  /*

                 ht = '<div class="dropbtn" data-scrollbar="true" data-height="100%"><ul class="nav">';
                 ht += '<li class="nav-profile">';
				 ht += '<div class="info">Menú</div></li></ul><ul class="nav"><li class="has-sub"><a href="javascript:;">';
				 ht += '<b class="caret pull-right"></b><i class="fa fa-laptop"></i><span><h3>Informaci&oacuten</h3></span>';
				 ht += '</a><ul class="sub-menu"><li><a href="index.html"><h3>Informe del Diálogo Nacional</h3></a></li>';
				 ht += '<li><a href="index_v2.html"><h3>Reporte General</h3></a></li>';
				ht +=  '<li><a href="index_v2.html"><h3>Reporte Productivo</h3></a></li>';
				ht += '</ul></li><li><a href="index.html"><h2>Próximas Mesas</h2></a></li>';
			    ht += '<li><a href="index.html"><h3>Noticias</h3></a></li></ul></div>';*/

                ht=' <div style="background-color:#193b68;display:table-cell; width:80%; height: 100%;"> ';
                ht+='<a href="/">Inicio</a>';
                ht+='<a href="http://www.planificacion.gob.ec/wp-content/uploads/downloads/2018/03/Informe-sobre-el-Dialogo-Nacional.pdf">Informaci&oacuten</a>';
  				ht+='<a href="/calendario-dialogo-nacional">Mesas</a>';
  				ht+='<a href="https://www.politica.gob.ec/noticias/">Noticias</a>';
				ht+='<a href="/login">Ingresar</a>';
				ht+='</div><div style="display:table-cell;background-color:#193b68;">';
  				ht+='<a href="javascript:void(0);" id="icon_menu" class="icon" onclick="myFunction()">';
				ht+='<i class="fa fa-bars"></i>';
			    ht+='</a></div>';


                div.innerHTML=ht;



                document.getElementById('sidebar').appendChild(div);
                 document.getElementById('sidebar').innerHTML=ht;

                var menutop1 = document.getElementById("top_table_menu");
                menutop1.style.display = "none";
                document.getElementById('sidebar').style.display="inline";

                // add a class .collapse to a div .showHide
                //$('.showHide').addClass('collapse');
                // set display: "" in css for the toggle button .btn.btn-primary
                //$('button.btn.btn-primary').css('display', '');// removes display property to make it visible
            });
        }
        else {
            $(function(){
            	 var x = document.getElementById("sidebar");
            	x.style.display = "none";
            	var menutop1 = document.getElementById("top_table_menu");
                menutop1.style.display = "block";




                // remove a class .collapse from a div .showHide
                //$('.showHide').removeClass('collapse');
                // set display: none in css for the toggle button .btn.btn-primary
                //$('button.btn.btn-primary').css('display', 'none');// hides button display on bigger screen
            });
        }
    }
    $(window).resize(expandCollapse); // calls the function when the window first loads
</script>
<style type="text/css">

    h2{
      font-size: 14px;

    }

	h3{
        font-size: 13px;

	}
</style>

<!--<div id="header" class="header navbar navbar-default navbar-fixed-top">-->
	<!-- begin container-fluid -->

<header>
<div class="head_table_menu" id="top_table_menu" name="top_table_menu">
<div id="top_menu">
  <div class="head_table" role="menu">
      <div id='links_top_menu_left'>


          <!--<img src="{{ asset('imagenes/dialogo_nacional/nueva_imagen/logo_blanco.png') }}" width="60px" height="60px" alt="Logo dialogo nacional"/> -->

         <img src="{{ asset('imagenes/dialogo_nacional/nueva_imagen/logo_blanco.png') }}" width="60px" height="60px" alt="Logo dialogo nacional"/>
      </div>


      <div id="dv_ingreso" >


                   <!-- {{ asset('imagenes/dialogo_nacional/nueva_imagen/home_hover.png') }}-->

                <a class="barra_menu" href="/" tabindex=1>
                   <img src="{{ asset('imagenes/dialogo_nacional/nueva_imagen/home.png') }}" width="20px" height="20px" alt="Logo en forma de megafono" onmouseover="this.src='{{ asset($path_home_img_hover) }}'"
                    onmouseout="this.src='{{ asset($path_home_img) }}'"/>
                    INICIO
                </a>
    &nbsp; &nbsp;
                <div class="dropdown">
				  <div class="dropbtn">

				  	<a class="barra_menu" href="#" tabindex=2>
                   <img src="{{ asset('imagenes/dialogo_nacional/nueva_imagen/megafono.png') }}" width="20px" height="20px" alt="Logo en forma de megafono" onmouseover="this.src='{{ asset($path_megafono_hover) }}'"
                    onmouseout="this.src='{{ asset($path_megafono) }}'"/>
                    INFORMACI&OacuteN
                </a>
				  </div>
				  <div class="dropdown-content">
				    <a tabindex="3" class="text-left" href="http://www.planificacion.gob.ec/wp-content/uploads/downloads/2018/03/Informe-sobre-el-Dialogo-Nacional.pdf" >
																			<h3 class="dropdown-header" >Informe del Diálogo Nacional</h3>
																			<div class="row">
																					<div class="col-md-12 col-xs-12">
																								<img src="{{ asset('imagenes/dialogo_nacional/portada_informe_dialogo.png') }}" class="img-rounded" alt="imagen de portada de informe de dialogo nacional" width="125px" height="125px">
																					</div>
																			</div>
					</a>
				    <a tabindex="4" href="{{ url('/reporte') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>Reporte General</a>
				    <a tabindex="5" href="http://www.inteligenciaproductiva.gob.ec/dialogo-nacional-estadisticas" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>Productivo</a>
				  </div>
				</div>

                

			  
               
      </div>


      <div  id="dv_ingreso2" >
	                <a class="barra_menu" href="/calendario-dialogo-nacional"  tabindex=5>
	                   <img src="{{ asset('imagenes/dialogo_nacional/nueva_imagen/mesas_ico.png') }}" width="20px" height="20px" alt="Logo en forma de mundo"   onmouseover="this.src='{{ asset($path_mesas_ico_hover) }}'"
	                    onmouseout="this.src='{{ asset($path_mesas_ico) }}'"/>
	                    MESAS
	                </a>

      </div>



      <div  id="dv_ingreso2" >
      	<div class="vl2"></div>
      </div>
      

      <div  id="dv_ingreso2" >
      	
                <a class="barra_menu" href="https://www.politica.gob.ec/noticias/" tabindex=6 >

                   <img id="menu_ico_not" src="{{ asset('imagenes/dialogo_nacional/nueva_imagen/noticias.png') }}" width="20px" height="20px" alt="Logo en forma de mundo" onmouseover="this.src='{{ asset($path_noticias_hover) }}'"
                    onmouseout="this.src='{{ asset($path_noticias) }}'" />
                    NOTICIAS
                </a>


      </div>


      <div  id="dv_ingreso2" >
      	<div class="vl2"></div>
      </div>
      <div  id="dv_ingreso2" >

              <a class="barra_menu" href="/login" tabindex=7 >
          <img id="menu_ico_not" src="{{ asset('imagenes/dialogo_nacional/nueva_imagen/login.png') }}" width="20px" height="20px" alt="Logo en forma de mundo" onmouseover="this.src='{{ asset($path_login) }}'"   onmouseout="this.src='{{ asset($path_login_hover) }}'" />
                  INGRESO
              </a>


      </div>


  </div><!-- -->
</div><!-- end of row1-->


</div>



<!--<div id="sidebar" class="sidebar toggled" >
	HOLA MUNDO
>>>>>>> ee76071994a6d12fc252e1fff36a96c228355ce3
</div>
<div class="sidebar-bg"></div>-->
<div id="sidebar" class="topnav" >

 </div> 
</header>



<div class="sidebar-bg"></div>
<script>
function myFunction() {
    var x = document.getElementById("sidebar");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }

    var x = document.getElementById("icon_menu");
    if (x.className === "icon") {
        x.className += " responsive_ico";
    } else {
        x.className = "icon";
    }

    
}
</script>
	<!-- end container-fluid -->
<!--</div>-->

<!-- end #header -->

<!-- ////// -->
<!-- SIDEBAR -->
<!-- ////// -->
<div class="sidebar-bg"></div>

<!-- end #sidebar -->
