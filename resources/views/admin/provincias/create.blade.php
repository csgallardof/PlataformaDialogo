@extends('layouts.app')
@section('edit_titulo')Registrar @endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@yield('edit_titulo') Provincia <a href="{{ route('provincias.index') }}" class="btn btn-primary pull-right">Regresar</a>
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('provincias.store') }}/@yield('edit_id')">
                        {{ csrf_field() }}
                        @section('edit_Method')
                        @show
                        
                        <div class="form-group">
                            <label for="nombre_provincia" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="nombre_provincia" type="text" class="form-control" name="nombre_provincia" placeholder="Provincia" required value="@yield('edit_nombre')"  autofocus>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="regiones" class="col-md-4 control-label">Regi&oacute;n</label>

                            <div class="col-md-6">
                                <select class="form-control" name="regiones" id="regiones">
                                    <option value="1">Costa</option>
                                    <option value="2">Sierra</option>
                                    <option value="3">Oriente</option>
                                    <option value="4">Insular</option>
                                </select>

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


