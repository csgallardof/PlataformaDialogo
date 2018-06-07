@extends('layouts.app')
@section('edit_titulo')Registrar @endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@yield('edit_titulo') Consejo Sectorial - Instituci&oacute;n<a href="{{ route('consejoInstituciones.index') }}" class="btn btn-primary pull-right">Regresar</a>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('consejoInstituciones.store') }}/@yield('edit_id')">
                        {{ csrf_field() }}
                        @section('edit_Method')
                        @show

                        <div class="form-group">
                            <label for="consejo_id" class="col-md-4 control-label">Sectores</label>

                            <div class="col-md-6">
                                <select class="form-control" name="consejo_id" id="consejo_id">
                                    @if( isset($consejo) )
                                    @foreach( $consejo as $sect )
                                    <option value="{{ $sect->id}}">
                                        {{ $sect->nombre_consejo}}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="institucion_id" class="col-md-4 control-label">Instituci&oacute;n</label>

                            <div class="col-md-6">

                                <select class="form-control" name="institucion_id" id="institucion_id">

                                    @if( isset($institucion) )
                                    @foreach( $institucion as $ins )
                                    <option value="{{ $ins->id}}">
                                        {{ $ins->nombre_institucion}}
                                    </option>
                                    @endforeach

                                    @endif
                                </select>
                            </div>
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    Agregar
                                </button>
                            </div>
                        </div>

                        <div class="form-group">

                            <div id="divInstitucion" name="divInstitucion" class="col-md-8">
                                Grupo de Institucones .....

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>

$(document).ready(function () {
        $('#consejo_id').change(function () {
        var consejo_id = $('#consejo_id').val();
        console.log('entro' + consejo_id);
         $('#divInstitucion').html('');
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '/consejoInstitucionesListar/' + consejo_id,
            data: {'consejo_id': consejo_id},
            success: function (data) {
                
               $.each(data, function (index) {
                    $('#divInstitucion').append('<div>' + data[index].nombre_institucion + ' <a  > Quitar </a></div>');
                }); 
            }
        });
    });

});
</script>

@endsection


