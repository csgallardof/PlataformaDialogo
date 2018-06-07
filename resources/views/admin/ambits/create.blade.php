@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@yield('edit_titulo') &Aacute;mbito <a href="{{ route('ambits.index') }}" class="btn btn-primary pull-right">Regresar</a>
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('ambits.store')}}@if(isset($item))/@yield('edit_id')@endif"
                    >
                        {{ csrf_field() }}
                        @section('edit_Method')
                        @show
                            
                        <div class="form-group">
                            <label for="nombre_thematic" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="nombre_ambits" type="text" class="form-control" name="nombre_ambit" placeholder="ambito" required value="@if(isset($item))@yield('edit_nombre')@endif"  autofocus>

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


