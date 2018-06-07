@extends('layouts.app')

@section('content')

@section('start_css')
  @parent
    <link href="{{ asset('plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/jquery-file-upload/css/jquery.fileupload.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/jquery-file-upload/css/jquery.fileupload-ui.css') }}" rel="stylesheet" />
    <style type="text/css">
        .thumb {
            height: 500px;
            width: 500px;
            border: 5px solid #000;
        }
    </style>
@endsection
			
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                	<br>
                	<h4><b>Vocaciones productivas</b></h4>
                	<hr>
                    @include('flash::message')
                    <b>Seleccione una provincia: &nbsp;</b>
					<select id="seleccion">
						@foreach($provincias as $provincia)
							<option value='{{ $provincia-> id }}'>{{ $provincia-> nombre_provincia }}</option>
						@endforeach
					</select>
					
					<div class="pull-right">
						<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#modalCambiarImagen">Editar</a>
					</div>
					<br><br>
					<p id="textoProvincia">
						A continuaci&oacute;n se muestra la imagen actual de la vocaci&oacute;n productiva de <u>Azuay</u>
					</p>
 						
 					<div class="row">
 						<div class="col-md-8 col-md-offset-2">
 							<img id="caja1" width="80%" class="img-responsive center-block" src="{{ asset('imagenes/vocaciones_productivas_ecuador/vocaciones_productivas_azuay.jpg') }}"/>
 						</div> 	
 					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalCambiarImagen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <br>
                    <div id="textoHeaderModal">
                    	<h4><b>Azuay</b> (cambiar imagen)</h4>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="panel panel-inverse">
                        <div class="panel-body">            
                            <blockquote class="f-s-14">
                                <h4>Procedimiento:</h4>
                                <ol>
                                    <li>Haga clik en <b>"A&ntilde;adir"</b> y seleccione la imagen.</li>
                                    <li>Haga click en <b>"Guardar"</b>.</li>
                                </ol>
                            </blockquote>
                            <form id="fileupload" action="{{ url('vocaciones_productivas') }}" method="POST" files="true" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="provincia" id="idProvincia" value="1">
                                <div class="row fileupload-buttonbar">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button class="btn btn-success fileinput-button">
                                            <i class="fa fa-plus"></i>
                                            <span>Agregar</span>
                                            <input type="file" name="imagen" id="imagen" required accept="image/jpg">
                                        </button>
                                    
                                        <button type="submit" class="btn btn-primary start">
                                            <i class="fa fa-save"></i>
                                            <span>Guardar</span>
                                        </button>
                                    </div>
                                    <br>
                                    <div class="col-md-8 col-md-offset-1">
                                        <output id="vistaPrevia"></output>
                                    </div>
                                </div>
                            </form>

                            <br>
                            <div class="note note-info" style="padding-bottom: -20px;">
                                <h4>Nota</h4>
                                <ul>
                                    <li>Solo se permiten im&aacute;genes con extensi&oacute;n <strong>.jpg</strong></li>
                                </ul>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal" >Cancelar</button>
                        </div>

                    </div>
                </div>
                	
            </div>
        </div>
</div>
	

@endsection

@section('init_scripts')

    <!-- Cargar datos provincias DOM -->
    <script type="text/javascript">
        $(document).ready(function(){           
            $("#seleccion").change(function() {
                valor = null;
                var num = $(this).val();
                if(num == 1){
                    valor =  'azuay';
                }
                if(num == 2){
                    valor =  'bolivar';
                }
                if(num == 3){
                    valor =  'canar';
                }
                if(num == 4){
                    valor =  'carchi';
                }
                if(num == 5){
                    valor =  'chimborazo';
                }
                if(num == 6){
                    valor =  'cotopaxi';
                }
                if(num == 7){
                    valor =  'eloro';
                }
                if(num == 8){
                    valor =  'esmeraldas';
                }
                if(num == 9){
                    valor =  'galapagos';
                }
                if(num == 10){
                    valor =  'guayas';
                }
                if(num == 11){
                    valor =  'imbabura';
                }
                if(num == 12){
                    valor =  'loja';
                }
                if(num == 13){
                    valor =  'losrios';
                }
                if(num == 14){
                    valor =  'manabi';
                }
                if(num == 15){
                    valor =  'moronasantiago';
                }
                if(num == 16){
                    valor =  'napo';
                }
                if(num == 17){
                    valor =  'orellana';
                }
                if(num == 18){
                    valor =  'pastaza';
                }
                if(num == 19){
                    valor =  'pichincha';
                }
                if(num == 20){
                    valor =  'santaelena';
                }
                if(num == 21){
                    valor =  'santodomingo';
                }
                if(num == 22){
                    valor =  'sucumbios';
                }
                if(num == 23){
                    valor =  'tungurahua';
                }
                if(num == 24){
                    valor =  'zamorachinchipe';
                }

                var provincia = $("#seleccion option:selected").text();
               
                $('#caja1').prop("src", "/imagenes/vocaciones_productivas_ecuador/vocaciones_productivas_" + valor + ".jpg");
                $("#textoProvincia").html("A continuaci&oacute;n se muestra la imagen actual de la vocaci&oacute;n productiva de <u>" + provincia +"</u>");

                $("#textoHeaderModal").empty();
                $("#textoHeaderModal").html("<h4><b>" + provincia + "</b> (cambiar imagen)</4>");
                
                $("#idProvincia").val(num);
                
            });           
        });
    </script>

    {{-- Vista previa para visualizar imagen --}}
    <script>
          function archivo(evt) {
            var files = evt.target.files; // FileList object
        
            // Obtenemos la imagen del campo "file".
            for (var i = 0, f; f = files[i]; i++) {
              //Solo admitimos imágenes.
              if (!f.type.match('image.*')) {
                continue;
              }
        
              var reader = new FileReader();
        
              reader.onload = (function(theFile) {
                return function(e) {
                  // Insertamos la imagen
                 document.getElementById("vistaPrevia").innerHTML = ['Vista Previa:<br> <img class="thumb" width="50%" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                };
              })(f);
        
              reader.readAsDataURL(f);
            }
          }
        
          document.getElementById('imagen').addEventListener('change', archivo, false);
    </script>

@endsection


    