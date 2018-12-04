<!--@extends('admin.eventos.create')

@section('edit_titulo') Editar @endsection

@section('edit_nombre',$item->nombre_evento) 
@section('edit_id',$item->id) 

@section('edit_link') Actualizar @endsection

@section('edit_Method')
    {{ method_field('PUT') }}
@endsection


-->



<!--@extends('layouts.main') -->
@section('title', 'Editar Evento')
@section('contenido')
        

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@yield('edit_titulo') Eventos <a href="{{ route('recuperarEventos') }}" class="btn btn-primary pull-right">Regresar</a>

                </div>
           
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{'/actualiza-evento/'.$item->id}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
 					@include('flash::message')                            
                        <div class="form-group">
                            <label for="nombre_evento" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="nombre_evento" type="text" class="form-control" name="nombre_evento" placeholder="evento" required value="{{$item->nombre_evento}}"  autofocus>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="provincia_id" class="col-md-4 control-label">Provincia</label>

                            <div class="col-md-6">

                                <select id="provincia_id"  class="form-control" name="provincia_id" placeholder="evento" required   autofocus>

                                    @foreach($provincias as $prov)
                                        @if($prov->id==$item->provincia_id)
                                          <option value="{{$prov->id}}" selected="selected">{{$prov->nombre_provincia}}</option>
                                        @else
                                          <option value="{{$prov->id}}">{{$prov->nombre_provincia}}</option>
                                        @endif    
                                    @endforeach
                                </select>

                            </div>
                        </div>


                       <div class="form-group">
                            <label for="calendar" class="col-md-4 control-label">Fecha Evento</label>

                            <div class="col-md-6">
                            	
                              <!--  <input id="calendar" type="date"  required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" name="calendar" value="{{$item->created_at}}">-->

                              <!-- pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" -->
						<input id="calendar" type="date"  required name="calendar" value="{{$fecha}}">
                              

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



