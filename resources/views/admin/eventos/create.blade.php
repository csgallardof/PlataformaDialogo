@extends('layouts.main')

@section('title', 'Ingreso de Evento')
@section('contenido')
        

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@yield('edit_titulo') Eventos <a href="{{ route('recuperarEventos') }}" class="btn btn-primary pull-right">Regresar</a>

                </div>
           
                <div class="panel-body">
                    <form class="form-horizontal" method="post" action="{{'/insert-evento/'}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                       <!-- @section('edit_Method')-->
                        @include('flash::message')
                        <!--@show-->
                            
                        <div class="form-group">
                            <label for="nombre_evento" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="nombre_evento" type="text" class="form-control" name="nombre_evento" placeholder="evento" required value="@yield('edit_nombre')"  autofocus>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="provincia_id" class="col-md-4 control-label">Provincia</label>

                            <div class="col-md-6">

                                <select id="provincia_id"  class="form-control" name="provincia_id" placeholder="evento" required   autofocus>

                                    @foreach($provincias as $prov)
                                        <option value="{{$prov->id}}">{{$prov->nombre_provincia}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>


                       <div class="form-group">
                            <label for="created_at" class="col-md-4 control-label">Fecha Evento</label>

                            <div class="col-md-6">
                                

                                <input id="calendar" type="date" name="calendar" value="{{ date('Y-m-d') }}">

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



