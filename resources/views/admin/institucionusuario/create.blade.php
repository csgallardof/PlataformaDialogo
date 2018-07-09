@extends('layouts.app')
@section('edit_titulo')Registrar @endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@yield('edit_titulo') Consejo Sectorial - Instituci&oacute;n<a href="{{ route('institucionUsuarios.index') }}" class="btn btn-primary pull-right">Regresar</a>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('institucionUsuarios.store') }}/@yield(':x')">
                        {{ csrf_field() }}
                        @section('edit_Method')
                        @show

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
                                 
                          
                        </div>

                        <div class="form-group">
                         <label for="usuario_id" class="col-md-4 control-label">Usuario</label>

                            <div class="col-md-6">
                                <select class="form-control" name="usuario_id" id="usuario_id">

                                    @if( isset($usuario) )
                                    @foreach( $usuario as $sect )
                                    <option value="{{ $sect->id}}">
                                         {{ $sect->apellidos}} {{ $sect->name}} / {{ $sect->email}}
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
                     
 

                    <div class="form-group panel-body ">

                        <div id="divInstitucion" name="divInstitucion"  class="table-responsive ">
                            Grupo de Usuario por Instituci&o&oacute;n .....

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
    $('#institucion_id').change(function () {
        onChangeSector();
    });
});
 
$(window).load(function () {
    onChangeSector();
});
function onChangeSector() {

    var institucion_id = $('#institucion_id').val();
    console.log('entro' + institucion_id);
    $('#divInstitucion').html('');
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: '/admin/institucionUsuariosListar/' + institucion_id,
        data: {'institucion_id': institucion_id},
        success: function (data) {
console.log(data);
            $.each(data, function (index) {
                $('#divInstitucion').append(' <div class= "col-sm-9" >' + data[index].apellidos + ' '+ data[index].name +' / '+ data[index].email + '</div> <div class= "col-sm-1" ><a class="btn btn-danger" href="/admin/delete-institucion-usuarios/' + data[index].id + '/delete" onclick = "if (! confirm(\'Desea quitar de la lista\')) { return false; }"  > Quitar </a></div>');
            });
        }
    });
}

</script>

@endsection


