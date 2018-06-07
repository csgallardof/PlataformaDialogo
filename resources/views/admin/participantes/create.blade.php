@extends('layouts.app')

@section('edit_titulo')Registrar @endsection

@section('start_css')
  @parent
  <link href="{{ asset('plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/jquery-file-upload/css/jquery.fileupload.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/jquery-file-upload/css/jquery.fileupload-ui.css') }}" rel="stylesheet" />

  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="{{ asset('plugins/jquery-ui/themes/base/minified/jquery-ui.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('/css/animate.min.css') }}" rel="stylesheet" /> 
  <link href="{{ asset('/css/style-responsive.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('/css/theme/default.css') }}" rel="stylesheet" id="theme" />

@endsection

@section('edit_titulo')Registro de participantes @endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@yield('edit_titulo') Registro de participantes <a href="{{ route('participantes.index') }}" class="btn btn-primary pull-right">Regresar</a>
                </div>

                <div class="panel panel-inverse">
                    <div class="panel-body">            
                        <blockquote class="f-s-14">
                            <ol>
                                <li>A&ntilde;ada la matriz.</li>
                                <li>Haga click en vista previa para visualizar errores o subir los participantes.</li>
                            </ol>
                        </blockquote>
                        <form id="fileupload" action="{{ url('/admin/participantes/vistaPreviaRegistro') }}" method="POST" files="true" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="row fileupload-buttonbar">
                                <div class="col-md-8 col-md-offset-4">
                                    <button class="btn btn-success fileinput-button">
                                        <i class="fa fa-plus"></i>
                                        <span>Agregar</span>
                                        <input type="file" name="archivo" required>
                                    </button>
                                
                                    <button type="submit" class="btn btn-primary start">
                                        <i class="fa fa-list-alt"></i>
                                        <span>Vista Previa</span>
                                    </button>
                                </div>
                                
                            </div>
                            
                        </form>
                  

                        <div class="note note-info">
                            <h4>Notas</h4>
                            <ul>
                                <li>Solo se permiten archivos con formato de la matriz y con extensi&oacute;n <strong>.xlsx</strong>.</li>
                            </ul>
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

 
    <!-- The template to display files available for upload -->
    <!--
    <script id="template-upload" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-upload fade">
                
                <td>
                    <p class="name">{%=file.name%}</p>
                    <strong class="error text-danger"></strong>
                </td>
                <td>
                    {% if (!i) { %}
                        <button class="btn btn-white btn-sm cancel">
                            <i class="fa fa-ban"></i>
                            <span>Quitar</span>
                        </button>
                    {% } %}
                </td>
            </tr>
        {% } %}
    </script>
    -->
    
    <!-- The template to display files available for download -->
    <!--
    <script id="template-download" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-download fade">
                <td>
                    <span class="preview">
                        {% if (file.thumbnailUrl) { %}
                            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                        {% } %}
                    </span>
                </td>
                
                <td>
                    <span class="size">{%=o.formatFileSize(file.size)%}</span>
                </td>
               
            </tr>
        {% } %}
    </script>
    -->
    

    <script src="{{ asset('plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('js/apps.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ asset('plugins/jquery/jquery-1.9.1.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery/jquery-migrate-1.1.0.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-ui/ui/minified/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--[if lt IE 9]>
        <script src="assets/crossbrowserjs/html5shiv.js"></script>
        <script src="assets/crossbrowserjs/respond.min.js"></script>
        <script src="assets/crossbrowserjs/excanvas.min.js"></script>
    <![endif]-->
    <script src="{{ asset('plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-cookie/jquery.cookie.js') }}"></script>
    <!-- ================== END BASE JS ================== -->
    
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="{{ asset('plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('plugins/jquery-file-upload/js/vendor/tmpl.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-file-upload/js/vendor/load-image.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-file-upload/js/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('plugins/jquery-file-upload/js/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('plugins/jquery-file-upload/js/jquery.fileupload-process.js') }}"></script>
    <script src="{{ asset('plugins/jquery-file-upload/js/jquery.fileupload-image.js') }}"></script>
    <script src="{{ asset('plugins/jquery-file-upload/js/jquery.fileupload-audio.js') }}"></script>
    <script src="{{ asset('plugins/jquery-file-upload/js/jquery.fileupload-video.js') }}"></script>
    <script src="{{ asset('plugins/jquery-file-upload/js/jquery.fileupload-validate.js') }}"></script>
    <script src="{{ asset('plugins/jquery-file-upload/js/jquery.fileupload-ui.js') }}"></script>
    <!--[if (gte IE 8)&(lt IE 10)]>
        <script src="assets/plugins/jquery-file-upload/js/cors/jquery.xdr-transport.js"></script>
    <![endif]-->
    <script src="{{ asset('js/form-multiple-upload.demo.min.js') }}"></script>
    <script src="{{ asset('js/apps.min.js') }}"></script>

@endsection
