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
  <script src="{{ asset('js/Canton/comboCanton.js') }}"></script>
@endsection

@section('edit_titulo')Registrar @endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-2" style="margin-left: 0%">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h4>@yield('edit_titulo') Mesa de Dialogo</h4>
                    <a href="{{ route('mesadialogo.index') }}" class="btn btn-primary pull-right">Regresar</a>
                    <br><br>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('/admin/mesadialogo') }}/@yield('edit_id')">
                        {{ csrf_field() }}

                        @section('edit_Method')
                        @show
                        <input type="hidden" name="nuevo" value="{{$nuevo}}">
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="nombre">Nombre:</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de la mesa" value="@yield('edit_nombre')" required autofocus>
                            </div>
                            <label class="col-md-2 control-label" for="tipo_dialogo_id" >Tipo:</label>
                            <div class="col-md-4">
                                <select class="form-control" id="tipo_dialogo_id" name="tipo_dialogo_id" required>
                                    <option value="">Seleccione un tipo</option>
                                    @foreach($tiposDialogo as $tipoDialogo)
                                        @if(isset($item) && $item->tipo_dialogo_id == $tipoDialogo->id)
                                            <option value="{{ $tipoDialogo->id }}" selected> 
                                                {{ $tipoDialogo->nombre }}
                                            </option>
                                        @else
                                            <option value="{{ $tipoDialogo->id }}"> 
                                                {{ $tipoDialogo->nombre }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="organizador_id">Organizador:</label>
                            <div class="col-md-4">
                                <select class="form-control" id="organizador_id" name="organizador_id" required>
                                    <option value="">Seleccione un organizador</option>
                                    @foreach($instituciones as $institucion)
                                        @if(isset($item) && $item->organizador_id == $institucion->id)
                                            <option value="{{ $institucion->id }}" selected> 
                                                {{ $institucion->nombre_institucion }}
                                            </option>
                                        @else
                                            <option value="{{ $institucion->id }}"> 
                                                {{ $institucion->nombre_institucion }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <label class="col-md-2 control-label" for="consejo_sectorial_id">Consejo sectorial:</label>
                            <div class="col-md-4">
                                <select class="form-control" id="consejo_sectorial_id" name="consejo_sectorial_id" >
                                    <option value="">Seleccione un consejo sectorial</option>
                                    @foreach($consejosSectoriales as $consejoSectorial)
                                        @if(isset($item) && $item->consejo_sectorial_id == $consejoSectorial->id)
                                            <option value="{{ $consejoSectorial->id }}" selected> 
                                                {{ $consejoSectorial->nombre_consejo }}
                                            </option>
                                        @else
                                            <option value="{{ $consejoSectorial->id }}"> 
                                                {{ $consejoSectorial->nombre_consejo }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="lider">Lider:</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="lider" name="lider" placeholder="Líder" value="@yield('edit_lider')">
                            </div>
                            <label class="col-md-2 control-label" for="coordinador">Coordinador:</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="coordinador" name="coordinador" placeholder="Coordinador" value="@yield('edit_coordinador')">
                            </div>
                        </div>                            
                        <div class="form-group">                                
                            <label class="col-md-2 control-label" for="lugar">Lugar:</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="lugar" name="lugar" placeholder="Lugar" value="@yield('edit_lugar')" required>
                            </div>
                            <label class="col-md-2 control-label" for="sistematizador">Sistematizador:</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="sistematizador" name="sistematizador" placeholder="Sistematizador, separado por comas" value="@yield('edit_sistematizador')">
                            </div>
                        </div>
                        <div class="form-group">
                                <label class="col-md-2 control-label" for="zona_id">Zona:</label>
                                <div class="col-md-4">
                                    <select class="form-control" id="select-zona" name="zona_id" onchange="getSelectProvincias();">
                                        <option value="">Seleccione una zona</option>
                                        @foreach($zonas as $zona)
                                            @if(isset($item) && $item->zona_id == $zona->id)
                                                <option value="{{ $zona->id }}" selected> 
                                                   {{ $zona->nombre }}
                                                </option>
                                            @else
                                                <option value="{{ $zona->id }}"> 
                                                    {{ $zona->nombre }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <label class="col-md-2 control-label" for="provincia_id">Provincia:</label>
                                <div class="col-md-4">
                                    <select class="form-control" id="select-provincia" name="provincia_id" onchange="getSelectCantones();">
                                        <option value="">Seleccione una provincia</option>
                                        @if(isset($provincias))
                                            @foreach($provincias as $provincia)
                                                @if(isset($item) && $item->provincia_id == $provincia->id)
                                                    <option value="{{ $provincia->id }}" selected> 
                                                       {{ $provincia->nombre_provincia }}
                                                    </option>
                                                @else
                                                    <option value="{{ $provincia->id }}"> 
                                                        {{ $provincia->nombre_provincia }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="canton_id">Cant&oacute;n:</label>
                                <div class="col-md-4">
                                    <select class="form-control" id="select-canto" name="canton_id" onchange="getSelectParroquias();">
                                        <option value="">Seleccione un cantón</option>
                                        @if(isset($cantones))
                                            @foreach($cantones as $canton)
                                                @if(isset($item) && $item->canton_id == $canton->id)
                                                    <option value="{{ $canton->id }}" selected> 
                                                        {{ $canton->nombre_canton }}
                                                    </option>
                                                @else
                                                    <option value="{{ $canton->id }}"> 
                                                        {{ $canton->nombre_canton }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <label class="col-md-2 control-label" for="parroquia_id">Parroquia:</label>
                                <div class="col-md-4">
                                    <select class="form-control" id="select-parroquia" name="parroquia_id" >
                                        <option value="">Seleccione una parroquia</option>
                                        @if(isset($parroquias))
                                            @foreach($parroquias as $parroquia)
                                                @if(isset($item) && $item->parroquia_id == $parroquia->id)
                                                    <option value="{{ $parroquia->id }}" selected> 
                                                        {{ $parroquia->nombre_parroquia }}
                                                    </option>
                                                @else
                                                    <option value="{{ $parroquia->id }}"> 
                                                        {{ $parroquia->nombre_parroquia }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="fecha">Fecha:</label>
                                <div class="col-md-4">
                                    @if(isset($item))
                                        <input type="date" class="form-control" id="fecha" name="fecha" placeholder="fechaha" value="{{date('Y-m-d',strtotime($item->fecha))}}" required >
                                    @else
                                        <input type="date" class="form-control" id="fecha" name="fecha" placeholder="fechacha" value="{{ date('Y-m-d')}}" required>
                                    @endif
                                </div>
                                <label class="col-md-2 control-label" for="organizacion">Organización:</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="organizacion" name="organizacion" placeholder="Organización" value="@yield('edit_organizacion')">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="sector_id">Sector:</label>
                                <div class="col-md-4">
                                    <select class="form-control" id="sector_id" name="sector_id" >
                                        <option value="">Seleccione un sector</option>
                                        @foreach($sectores as $sector)
                                            @if(isset($item) && $item->sector_id == $sector->id)
                                                <option value="{{ $sector->id }}" selected> 
                                                    {{ $sector->nombre_sector }}
                                                </option>
                                            @else
                                                <option value="{{ $sector->id }}"> 
                                                    {{ $sector->nombre_sector }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <label class="col-md-2 control-label" for="descripcion">Descripción:</label>
                                <div class="col-md-4">
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="2" placeholder="Descripcion de la mesa de dialogo">@yield('edit_descripcion')</textarea>
                                </div>
                            </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4" align="center">
                                <button type="submit" class="btn btn-primary">
                                     Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                                       
                    @if(count($errors)>0)
                        <div class="alert alert-warning">
                            @foreach($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@section('end_js')
    @parent
    <script src="{{ asset('js/Provincia/comboProvincia.js') }}"></script>
    <script src="{{ asset('js/Canton/comboCanton_mesa.js') }}"></script>
    <script src="{{ asset('js/Parroquia/comboParroquia.js') }}"></script>
@endsection