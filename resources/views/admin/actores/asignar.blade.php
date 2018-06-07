@extends('layouts.app') 

@section('start_css2')
<style>
.select_placeholder
{
    display:none;
}

</style>
</style>
@endsection
@section('content')
<br><br><br><br><br>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@yield('edit_titulo') Actor-Soluci&oacute;n <a href="{{ url('admin/actores') }}" class="btn btn-primary pull-right">Regresar</a>
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('actorSolucion.asignar') }}">
                        {{ csrf_field() }}
                        @section('edit_Method')
                        @show
                            
                        <div class="form-group">
                            <label for="institucion" class="col-md-4 control-label">Instituci&oacute;n:</label>

                            <div class="col-md-6">

                                <select class="form-control" name = "institucion" data-size="15" data-live-search="true" data-style="btn-info" required>
                                    <option selected="selected" class="select_placeholder">Seleccione una Instituci&oacute;n</option>
                                    @foreach($instituciones as $institucion)
                                        <option value="{{ $institucion->id }}" > {{ $institucion->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            
                            <label for="tipo_actor_id" class="col-md-4 control-label">Tipo:</label>
                           
                            <div class="col-md-6">

                                <select class="form-control" name="tipo_actor_id" id="tipo_actor" data-size="15" data-live-search="true" data-style="btn-info" required>
                                    <option selected="selected" class="select_placeholder">Seleccione un tipo de actor</option>
                                    <option value="1" > {{ "Responsable" }}</option>
                                    <option value="2" > {{ "Corresponsable" }}</option>
                                </select>

                            </div>
                            <label for="tipo_fuente" class="col-md-4 control-label">Fuente:</label>
                            <div class="col-md-6">

                                <select id="select-tipo-fuente" class="form-control" onchange="getSelectValue();" name="tipo_fuente_id"  data-size="15" data-live-search="true" data-style="btn-info" required>
                                    <option selected="selected" class="select_placeholder">Seleccione una fuente</option>
                                    <option value="1" > {{ "Mesas Competitivas" }}</option>
                                    <option value="2" > {{ "Consejo Consultivo" }}</option>
                                </select>

                            </div>
                            <label for="solucion" class="col-md-4 control-label">Soluci&oacute;n:</label>
                            

                            <div class="col-md-15">
                                <select  id="select-solucion" name="solucion_id" class="form-control" name="solucion_id"  data-size="10" required="" data-live-search="true" data-style="btn-inverse">
                                            <option value="" >Seleccione propuestas</option>
                                            
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

<!--                         <table class="table">
                            <tr>
                                <th>*</th>
                                <th>Soluci&oacute;n</th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>sadsadsadsad</td>
                            </tr>
                        </table> -->
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

