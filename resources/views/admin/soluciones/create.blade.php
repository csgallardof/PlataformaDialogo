@extends('layouts.app')

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

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Registro de Soluciones y Participantes</h4>
                    <a href="{{ route('soluciones.index') }}" class="btn btn-primary pull-right">Regresar</a>
                </div>

                <div class="panel panel-inverse">
                    <div class="panel-body">            
                        <blockquote class="f-s-14">
                            <h4>Procedimiento:</h4>
                            <ol>
                                <li>Haga clik en <b>"A&ntilde;adir"</b> y seleccione el archivo que contiene la matriz.</li>
                                <li>Haga click en <b>"Vista Previa"</b> para visualizar posibles errores o confirmar datos.</li>
                            </ol>
                        </blockquote>
                        <form id="fileupload" action="{{ url('/admin/soluciones/vistaPreviaMesas') }}" method="POST" files="true" enctype="multipart/form-data">
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
                            <h4>Nota</h4>
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

