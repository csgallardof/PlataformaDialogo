@extends('layouts.app')
@section('edit_titulo')Crear Instituci&oacute;n @endsection

@section('content')
<br>
<br><br><br>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@yield('edit_titulo') <a href="{{ route('instituciones.index') }}" class="btn btn-primary pull-right">Regresar</a>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('instituciones.store') }}@if(isset($item))/@yield('edit_id')@endif"
                    >
                        {{ csrf_field() }}
                        @section('edit_Method')
                        @show
                        
                        <div class="form-group">
                            <label for="nombre_institucion" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="nombre_institucion" type="text" class="form-control" name="nombre_institucion" placeholder="Nombre de Instituci&oacute;n" required required value="@if(isset($item))@yield('edit_nombre_institucion')@endif"   autofocus>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="siglas_institucion" class="col-md-4 control-label">Siglas</label>

                            <div class="col-md-6">
                                <input id="siglas_institucion" type="text" class="form-control" name="siglas_institucion" placeholder="Siglas" required value="@if(isset($item))@yield('edit_siglas_institucion')@endif"  autofocus>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                     Registrar
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
@endsection

