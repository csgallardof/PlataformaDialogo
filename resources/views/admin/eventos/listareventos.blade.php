
@extends('layouts.main')

@section('title', 'Inicio')
@section('contenido')
		<!-- begin #content -->

        
        <div id="content" class="content" width="10%">
            <div class="row">
                <form action="{{ url('/nuevo-evento') }}" method="GET" id="frNuevoEvent">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary pull-left">Nuevo Evento</button>
                </form>
            </div>
            <div  class="row">
            @include('flash::message')
        </div>
            <div class="row">
                <!-- begin col-8 -->

                <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
  
                            </div>
                            <h3 align="left" class="panel-title">Eventos Programados</h3>
                        </div>
                        {{ $eventos->links() }}
                        <div class="panel-body">

                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Evento</th>
                                            <th>Fecha</th>
                                            <th>Provincia</th>
                                            <th colspan="2">Acci&oacuten</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $eventos as $evento )
                                        <tr>
                                            <td class="text-justify">
                                                {{ $evento->id}}
                                            </td>

                                            <td class="text-justify">
                                                {{ $evento->nombre_evento}}
                                            </td>

                                            <td class="text-justify">
                                                {{ $evento->created_at}}
                                            </td>
                                            <td class="text-justify">
                                                @if($provincias)
                                                   @foreach($provincias as $prov)
                                                      @if($prov->id ==$evento->provincia_id)
                                                              {{ $prov->nombre_provincia}}
                                                       @endif
                                                  @endforeach   
                                                @endif   
                                            </td>
                                            <td class="text-justify">
                                                   <a href="{{ url('/editar-evento/'.$evento->id)}}" class="btn btn-link f-s-13 f-w-500">
                                                       Editar
                                                   </a> 

                                            </td>
                                            <td class="text-justify">
                                                   <a href="{{ url('/eliminar-evento/'.$evento->id) }}" class="btn btn-link f-s-13 f-w-500" onclick="return confirm('Esta seguro de eliminar el evento?')">
                                                       Eliminar
                                                   </a> 

                                            </td>



                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-10 -->


            </div>
            <!-- end row -->
        </div>
        <!-- end #content -->


@endsection